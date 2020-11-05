<template>
  <q-page>
    <div class="poster q-pa-md text-right">
      <q-input
        v-model="post_text"
        outlined
        autogrow
        label="O que você quer compartilhar?"
      />
      <q-btn color="primary" label="Publicar" 
        class="q-mt-sm" />
    </div>
    <div 
      v-for="post in posts"
      :key="post.postId"
      class="flex post q-py-md q-px-lg">
      <a @click="$router.push('/pet');" 
        class="flex flex-center">
        <img alt="Foto do Pet"
          class="profile-picture"
          :src="post.profilePicture">
        <p class="q-ma-none q-ml-sm">{{post.userName}}</p>
      </a>
      <article class="q-my-sm">
        {{post.content}}
      </article>
      <div v-if="post.photo" class="gallery">
        <img alt="Foto do Post"
          :src="post.photo"
          v-on:dblclick="toogleLike(post.postId)">
        <img alt="Amei"
          :class="'heart-photo ' + (post.liked ? 'liked' : '')"
          src="~assets/coracao.svg">
      </div>
      <q-btn 
        unelevated 
        rounded
        :outline="!post.liked"
        :class="'like-count q-mt-md ' + (post.liked ? 'liked' : '')"
        color="negative" 
        icon="favorite_border" 
        :label="post.likes" 
        @click="toogleLike(post.postId)" />
    </div>
  </q-page>
</template>

<script>

const postsList = [
  {
    postId: 1,
    liked: false,
    profilePicture: 'img/ehmole.jpg',
    userName: 'Nome Pet',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    photo: 'img/ehmole.jpg',
    likes: 0
  },
  {
    postId: 2,
    liked: true,
    profilePicture: 'img/cachorro2.jpg',
    userName: 'Nome Pet',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    photo: 'img/cachorro2.jpg',
    likes: 455
  },
  {
    postId: 3,
    liked: false,
    profilePicture: 'img/ehmole.jpg',
    userName: 'Nome Pet',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    photo: null,
    likes: 12
  }
]

export default {
  name: 'PageIndex',
  data () {
    return {
      post_text: '',
      posts: postsList
    }
  },
  methods: {
    toogleLike (postId) {
      for (let i = 0; i < this.posts.length; i++) {
        if (this.posts[i].postId === postId) {
          if (this.posts[i].liked) {
            this.posts[i].likes--
          } else {
            this.posts[i].likes++
          }
          this.posts[i].liked = !this.posts[i].liked
          break
        }
      }
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
  .post {
    align-items: end;
    flex-direction: column;
    background: rgba(213, 209, 112, 0.15);
  }
  .post + .post {
    margin-top: 20px;
  }
  .post a {
    cursor: pointer;
  }
  .post p {
    font-size: 20px;
    color: #528124;
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
    width: 400px;
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
  }
  .gallery .heart-photo.liked {
    z-index: 1;
  }
  .post .like-count {
    animation: bump 2s linear infinite;
  }
  .post .like-count.liked {
    animation: none;
  }
</style>
