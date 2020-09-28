<template>
  <div class="flex items-center">
    <div class="flex items-center justify-center cover" 
      v-bind:style="{ 
        backgroundImage: 'url(https://picsum.photos/200/300)' 
      }">
      <img alt="Foto do Perfil"
        class="profile-picture"
        src="~assets/ehmole.jpg">
    </div>
    <div class="q-px-lg q-mb-lg">
      <h4 class="text-center">Nome do Pet</h4>
      <article>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </article>
      <div class="q-my-lg text-center">
        <q-btn class="q-mt-sm"
        rounded color="primary" label="ADOTAR" />
      </div>
      <div class="gallery">
        <img alt="Foto do Pet"
          src="~assets/ehmole.jpg"
          v-on:dblclick="console.log('deu like')">
        <img alt="Foto do Pet"
          src="~assets/cachorro2.jpg">
        <img alt="Foto do Pet"
          src="~assets/ehmole.jpg">
        <img alt="Foto do Pet"
          src="~assets/cachorro2.jpg">
        <img alt="Foto do Pet"
          src="~assets/ehmole.jpg">
        <img alt="Foto do Pet"
          src="~assets/cachorro2.jpg">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PetProfile',
  data () {
    return {
      login: null,
      senha: null
    }
  }
}
</script>
<style type="text/css" scoped>
  .q-page-container > div {
    flex-direction: column;
  }
  .cover {
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    height: 160px;
    margin-bottom: 50px;
  }
  .profile-picture {
    width: 150px;
    height: 150px;
    border: 2px solid #528124;
    border-radius: 50%;
    margin-bottom: -150px;
  }
  h4 {
    margin: 35px 0 20px 0;
    color: #528124;
    font-style: 30px;
  }
  article {
    font-size: 15px;
  }
  button {
    width: 150px;
    margin: 0;
    font-size: 20px;
    font-weight: bold;
  }
  .gallery {
    display: flex;
    width: 100%;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  .gallery img {
    width: 120px;
    height: 100px;
    cursor: pointer;
  }
  .gallery img:nth-child(n+4) {
    margin: 35px 0 0 0;
  }
</style>
