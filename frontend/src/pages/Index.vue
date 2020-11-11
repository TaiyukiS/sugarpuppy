<template>
  <q-page>
    <q-pull-to-refresh @refresh="buscarPosts">
      <div class="poster q-py-md">
        <q-input
          v-model="post_text"
          outlined
          autogrow
          label="O que você quer compartilhar?"
        />
        <div class="q-mt-sm">
          <q-btn label="Adicionar foto" 
          v-if="!show_add_img"
          @click="show_add_img = true"
          class="q-mr-sm" unelevated outline />
          <q-input
            v-if="show_add_img"
            v-model="post_img"
            outlined
            dense
            label="Link da foto"
            class="q-mr-sm"
          />
          <q-btn v-if="show_add_img"
            @click="show_add_img = false"
            label="Cancelar" class="q-mr-sm" 
            unelevated outline />
          <q-btn color="primary" label="Publicar" 
            @click="publicar"
            class="float-right" />
        </div>
        <h6 v-if="msgPublishing" class="text-center">Publicando...</h6>
        <h6 v-if="msgOK" class="text-center">Publicado!</h6>
        <h6 v-if="msgError" class="text-center text-negative">Ops! Não foi possível publicar.</h6>
      </div>
      <h6 v-if="msgSearching" class="text-center">Buscando...</h6>
      <div 
        v-for="post in posts"
        :key="post.id"
        class="flex post q-py-md">
        <a @click="$router.push('/pet');" 
          class="flex flex-center q-px-lg heading">
          <img alt="Foto do Pet"
            class="profile-picture"
            :src="post.foto_poster">
          <p class="q-ma-none q-ml-sm">{{post.nome_poster}}</p>
          <span>{{formatDate(post.data_cadastro)}}</span>
        </a>
        <article class="q-my-sm q-px-lg">
          {{post.conteudo}}
        </article>
        <div v-if="post.url_foto" class="gallery">
          <img alt="Foto do Post"
            :src="post.url_foto"
            v-on:dblclick="toogleLike(post.id)">
          <img alt="Amei"
            v-if="post.liked"
            class="heart-photo"
            src="~assets/coracao.svg">
        </div>
        <div class="q-px-lg q-mt-md">
          <q-btn 
            unelevated 
            rounded
            :outline="!post.liked"
            :class="'like-count ' + (post.liked ? 'liked' : '')"
            color="negative" 
            icon="favorite_border" 
            :label="post.qtd_amei" 
            @click="toogleLike(post.id)" />
          <q-btn 
            unelevated 
            outline
            class="float-right"
            icon="create">
            <q-menu>
              <q-list>
                <q-item clickable v-close-popup>
                  <q-item-section
                    @click="editarPost(post.id)"
                  >Editar</q-item-section>
                </q-item>
                <q-item clickable v-close-popup>
                  <q-item-section
                    @click="apagarPost(post.id)"
                  >Apagar</q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </div>
    </q-pull-to-refresh>
  </q-page>
</template>

<script>
import { date } from 'quasar'
import { PostService } from '../services/posts'

export default {
  name: 'PageIndex',
  data () {
    return {
      post_text: '',
      post_img: '',
      show_add_img: false,
      msgPublishing: false,
      msgOK: false,
      msgError: false,
      msgSearching: false,
      posts: []
    }
  },
  mounted () {
    this.buscarPosts()
  },
  methods: {
    formatDate (dateStr) {
      return date.formatDate(new Date(dateStr), 'DD/MM/YYYY HH:mm')
    },
    toogleLike (postId) {
      let liked = null
      for (let i = 0; i < this.posts.length; i++) {
        if (this.posts[i].id === postId) {
          if (this.posts[i].liked) {
            this.posts[i].qtd_amei--
          } else {
            this.posts[i].qtd_amei++
          }
          this.posts[i].liked = !this.posts[i].liked
          liked = this.posts[i].liked
          break
        }
      }

      if (liked !== null) {
        if (liked) {
          PostService.like(postId)
        } else {
          PostService.dislike(postId)
        }
      }
    },
    publicar () {
      const post = {
        conteudo: this.post_text
      }
      if (this.show_add_img) {
        post.url_foto = this.post_img
      }

      this.msgPublishing = true
      this.msgOK = false
      this.msgError = false

      PostService.publicar(post)
        .then((res) => {
          this.posts.push(res)
          this.sucessoPublicar()
        })
        .catch(() => {
          this.erroPublicar()
        })
    },
    sucessoPublicar () {
      this.show_add_img = false
      this.post_text = ''
      this.post_img = ''
      this.msgPublishing = false
      this.msgOK = true
      setTimeout(() => {
        this.msgOK = false
      }, 2000)
    },
    erroPublicar () {
      this.show_add_img = false
      this.post_text = ''
      this.post_img = ''
      this.msgPublishing = false
      this.msgError = true
      setTimeout(() => {
        this.msgError = false
      }, 2000)
    },
    buscarPosts (done) {
      this.msgSearching = true
      PostService.get()
        .then((newPosts) => {
          this.posts = newPosts
          if (done) {
            done()
          }
        })
        .finally(() => {
          this.msgSearching = false
        })
    },
    editarPost (postId) {

    },
    apagarPost (postId) {

    }
  }
}
</script>
<style type="text/css" scoped>
  @keyframes bump {
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
  }
  .q-page {
    padding: 0 0 20px 0;
  }
  .poster {
    padding-bottom: 20px;
  }
  .poster > div > * {
    vertical-align: top;
  }
  .poster > div > .q-input {
    display: inline-block;
    width: 260px;
  }
  h6 {
    margin: 20px 0 0 0;
    color: #528124;
  }
  .post {
    align-items: end;
    flex-direction: column;
    background: rgba(213, 209, 112, 0.15);
  }
  .post + .post {
    margin-top: 20px;
  }
  .post > * {
    width: 100%;
  }
  .post .heading {
    justify-content: flex-start;
  }
  .post a {
    cursor: pointer;
  }
  .post p {
    flex: 1;
    font-size: 20px;
    color: #528124;
  }
  .post span {
    align-self: flex-start;
  }
  .post .profile-picture {
    width: 50px;
    height: 50px;
    border: 2px solid #528124;
    border-radius: 50%;
  }
  .post article {
    display: block;
    font-size: 15px;
  }
  .gallery {
    position: relative;
    display: flex;
    width: 100%;
    justify-content: center;
  }
  .gallery img {
    cursor: pointer;
    width: 100%;
  }
  .gallery .heart-photo {
    position: absolute;
    width: 80px;
    height: 80px;
    top: 50%;
    left: 50%;
    margin-top: -40px;
    margin-left: -40px;
    z-index: -1;
    pointer-events: none;
    animation: bump 2s linear infinite;
    z-index: 1;
  }
  .post .like-count {
    animation: bump 2s linear infinite;
  }
  .post .like-count.liked {
    animation: none;
  }
</style>
