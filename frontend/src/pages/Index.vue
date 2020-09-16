<template>
  <q-page>
    <div class="flex post q-py-md q-px-lg">
      <div class="flex flex-center">
        <img alt="Foto do Pet"
          class="profile-picture"
          src="~assets/quasar-logo-full.svg">
        <p class="q-ma-none q-ml-sm">Nome Pet</p>
      </div>
      <article class="q-my-sm">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </article>
      <div class="gallery">
        <img alt="Foto do Pet"
          src="~assets/quasar-logo-full.svg">
        <div>
          <img alt="Foto do Pet"
            src="~assets/quasar-logo-full.svg">
          <img alt="Foto do Pet"
            src="~assets/quasar-logo-full.svg">
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
  .post {
    background: rgba(213, 209, 112, 0.15);
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
  }
  .post .gallery > img {
    flex: 1;
  }
  .post .gallery > div {
    display: flex;
    width: 100px;
    flex-direction: column;
    justify-content: space-around;
  }
  .post .gallery > div > img {
    width: 100px;
    height: 70px;
  }
</style>
