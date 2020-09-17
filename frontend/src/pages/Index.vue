<template>
  <q-page>
    <div class="flex post q-py-md q-px-lg">
      <div class="flex flex-center">
        <img alt="Foto do Pet"
          class="profile-picture"
          src="~assets/ehmole.jpg">
        <p class="q-ma-none q-ml-sm">Nome Pet</p>
      </div>
      <article class="q-my-sm">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </article>
      <div class="gallery">
        <img alt="Foto do Pet"
          src="~assets/ehmole.jpg">
        <div>
          <img alt="Foto do Pet"
            src="~assets/ehmole.jpg">
          <img alt="Foto do Pet"
            src="~assets/ehmole.jpg">
        </div>
      </div>
    </div>
    <div class="flex post q-py-md q-px-lg">
      <div class="flex flex-center">
        <img alt="Foto do Pet"
          class="profile-picture"
          src="~assets/cachorro2.jpg">
        <p class="q-ma-none q-ml-sm">Nome Pet</p>
      </div>
      <article class="q-my-sm">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </article>
      <div class="gallery">
        <img alt="Foto do Pet"
          src="~assets/cachorro2.jpg">
        <div>
          <img alt="Foto do Pet"
            src="~assets/cachorro2.jpg">
          <img alt="Foto do Pet"
            src="~assets/cachorro2.jpg">
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageIndex'
}
</script>
<style type="text/css">
  .q-page {
    padding: 20px 0;
  }
  .post {
    background: rgba(213, 209, 112, 0.15);
  }
  .post + .post {
    margin-top: 20px;
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
    font-size: 15px;
  }
  .post .gallery {
    display: flex;
    width: 100%;
    justify-content: space-between;
  }
  .post .gallery img {
    cursor: pointer;
  }
  .post .gallery > img {
    width: 220px;
  }
  .post .gallery > div {
    display: flex;
    width: 100px;
    flex-direction: column;
    justify-content: space-around;
  }
  .post .gallery > div > img {
    width: 100px;
  }
</style>
