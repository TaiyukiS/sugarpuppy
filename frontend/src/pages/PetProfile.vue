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
    <h4>Bem-vinda Cláudia</h4>
    <div class="gallery">
      
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
</style>
