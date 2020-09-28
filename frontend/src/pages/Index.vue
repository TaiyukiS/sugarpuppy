<template>
  <q-page>
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
      <div class="gallery">
        <img alt="Foto do Pet"
          :src="post.mainPhoto"
          :class="
            (post.morePhotos.length == 0) ? 'single-photo' : ''
          "
          v-on:dblclick="toogleLike(post.postId)">
        <img alt="Amei"
          :class="'heart-photo ' + (post.liked ? 'liked' : '')"
          src="~assets/coracao.svg">
        <div>
          <img alt="Foto do Pet"
            v-for="photo in post.morePhotos"
            :src="photo.url"
            :key="photo.id">
        </div>
      </div>
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
    mainPhoto: 'img/ehmole.jpg',
    morePhotos: [
      { id: 1, url: 'img/ehmole.jpg' }
    ]
  },
  {
    postId: 2,
    liked: true,
    profilePicture: 'img/cachorro2.jpg',
    userName: 'Nome Pet',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    mainPhoto: 'img/cachorro2.jpg',
    morePhotos: [
      { id: 2, url: 'img/cachorro2.jpg' },
      { id: 3, url: 'img/cachorro2.jpg' },
      { id: 4, url: 'img/cachorro2.jpg' }
    ]
  },
  {
    postId: 3,
    liked: false,
    profilePicture: 'img/ehmole.jpg',
    userName: 'Nome Pet',
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    mainPhoto: 'img/ehmole.jpg',
    morePhotos: []
  }
]

export default {
  name: 'PageIndex',
  data () {
    return {
      posts: postsList
    }
  },
  methods: {
    toogleLike (postId) {
      for (let i = 0; i < this.posts.length; i++) {
        if (this.posts[i].postId === postId) {
          this.posts[i].liked = !this.posts[i].liked
          break
        }
      }
    }
  }
}
</script>
<style type="text/css" scoped>
  .q-page {
    padding: 20px 0;
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
    justify-content: space-between;
  }
  .gallery img {
    cursor: pointer;
  }
  .gallery > img {
    width: 305px;
    height: 305px;
  }
  .gallery .heart-photo {
    position: absolute;
    width: 80px;
    height: 80px;
    top: 112px;
    left: 112px;
    z-index: -1;
    pointer-events: none;
  }
  .gallery > .single-photo + .heart-photo {
    top: 170px;
    left: 170px;
  }
  .gallery .heart-photo.liked {
    z-index: 1;
  }
  .gallery .single-photo {
    margin: 0 auto;
    width: 420px;
    height: 420px;
  }
  .gallery > div {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }
  .gallery > div > img {
    width: 110px;
    height: 90px;
  }
  .gallery > div > img + img {
    margin-top: 15px;
  }
</style>
