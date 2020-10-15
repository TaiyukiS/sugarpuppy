<template>
  <div class="flex items-center q-pt-sm q-px-sm">
    <q-carousel
      v-model="slide"
      slide="style"
      swipeable
      animated
      padding
      height="460px"
      class="q-mb-md"
    >
      <q-carousel-slide 
        v-for="pet in petList"
        :key="pet.id"
        :name="pet.id">
        <img alt="Foto do Perfil"
          class="profile-picture"
          :src="pet.profilePicture">
        <h4 class="text-center">{{pet.name}}</h4>
        <article>{{pet.description}}</article>
      </q-carousel-slide>
    </q-carousel>
    <div class="buttons flex q-mb-md q-px-sm">
      <q-btn rounded color="negative" icon="close" />
      <q-btn rounded color="primary" icon="done" />
    </div>
  </div>
</template>

<script>
const pets = [
  {
    id: 1,
    profilePicture: 'https://picsum.photos/300/300',
    name: 'Nome do Pet',
    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      <ul>
        <li><b>Raça</b>: X</li>
        <li><b>Cidade</b>: RS</li>
      </ul>`
  },
  {
    id: 2,
    profilePicture: 'https://picsum.photos/350/300',
    name: 'Nome do Pet 2',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  }
]

export default {
  name: 'SearchPet',
  data () {
    return {
      slide: 1,
      petList: pets
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
    display: block;
    margin: 0 auto;
    width: 330px;
    height: 350px;
    pointer-events: none;
  }
  .q-carousel__slide {
    padding: 0 !important;
  }
  h4 {
    margin: 10px 0 0 0;
    color: #528124;
    font-size: 30px;
  }
  article {
    padding: 0 15px;
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
