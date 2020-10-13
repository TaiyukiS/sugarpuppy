<template>
  <div class="flex items-center q-pt-sm">
    <img alt="Foto do Perfil"
      class="profile-picture"
      src="https://picsum.photos/300/300">
    <h4 class="text-center">Nome do Pet</h4>
    <article>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      <ul>
        <li><b>Raça</b>: X</li>
        <li><b>Cidade</b>: RS</li>
      </ul>
    </article>
    <div class="buttons flex q-mb-md q-px-sm">
      <q-btn rounded color="negative" icon="close" />
      <q-btn rounded color="primary" icon="done" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchPet'
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
    width: 350px;
    height: 370px;
  }
  h4 {
    margin: 15px 0;
    color: #528124;
    font-style: 30px;
  }
  article {
    font-size: 15px;
  }
  article ul {
    padding-left: 0;
    list-style: none;
  }
  article ul b {
    color: #AAB952;
  }
  .buttons {
    width: 100%;
    justify-content: space-around;
  }
  button {
    width: 70px;
    height: 70px;
    font-size: 20px;
    border-radius: 50%;
    font-weight: bold;
  }
</style>
