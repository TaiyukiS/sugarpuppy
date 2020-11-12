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
                    @click="abrirEdicao(post.id)"
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
    <q-dialog
      :value="show_edit_post"
      @input="fecharEdicao()"
    >
      <q-card style="width: 700px; max-width: 80vw;">
        <q-card-section class="post">
          <div class="flex flex-center q-px-lg heading">
            <img alt="Foto do Pet"
              class="profile-picture"
              :src="postEdit.foto_poster">
            <p class="q-ma-none q-ml-sm">{{postEdit.nome_poster}}</p>
            <span>{{formatDate(postEdit.data_cadastro)}}</span>
          </div>
          <div class="poster">
            <q-input
              v-model="postEdit.conteudo"
              class="q-my-sm q-px-lg"
              outlined
              autogrow
            />
            <div class="q-mt-sm q-px-lg">
              <q-btn label="Adicionar foto" 
              v-if="!show_add_img_edit"
              @click="show_add_img_edit = true"
              class="q-mr-sm" unelevated outline />
              <q-input
                v-if="show_add_img_edit"
                v-model="postEdit.url_foto"
                outlined
                dense
                label="Link da foto"
                class="q-mr-sm"
              />
              <q-btn v-if="show_add_img_edit"
                @click="show_add_img_edit = false"
                label="Cancelar" class="q-mr-sm" 
                unelevated outline />
            </div>
          </div>
          <div v-if="postEdit.url_foto && show_add_img_edit" class="gallery">
            <img alt="Foto do Post"
              :src="postEdit.url_foto">
          </div>
        </q-card-section>
        <q-card-actions align="center">
          <q-btn
            unelevated
            @click="fecharEdicao"
            label="Cancelar"
          />
          <q-btn
            unelevated
            color="primary"
            @click="fecharEdicao"
            label="Atualizar"
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
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
      show_add_img_edit: false,
      show_edit_post: false,
      msgPublishing: false,
      msgSearching: false,
      posts: [],
      postEdit: {}
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
      this.$q.notify({
        message: 'Publicado!',
        color: 'primary'
      })
    },
    erroPublicar () {
      this.show_add_img = false
      this.post_text = ''
      this.post_img = ''
      this.msgPublishing = false
      this.$q.notify({
        message: 'Ops! Houve algum erro',
        color: 'negative'
      })
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
    abrirEdicao (postId) {
      const post = this.posts.filter((post) => {
        return post.id === postId
      })
      if (post.length > 0) {
        this.postEdit = post[0]
        this.show_add_img_edit = false
        if (this.postEdit.url_foto) {
          this.show_add_img_edit = true
        }
        this.show_edit_post = true
      }
    },
    fecharEdicao () {
      this.show_add_img_edit = false
      this.show_edit_post = false
      this.postEdit = {}
    },
    editarPost (postId) {
      for (let i = 0; i < this.posts.length; i++) {
        if (this.posts[i].id === postId) {
          this.posts[i] = this.postEdit
          break
        }
      }
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
  .post.q-card__section {
    padding: 20px 0;
    background: #FFFFFF;
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
