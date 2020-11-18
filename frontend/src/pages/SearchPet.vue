<template>
  <div class="flex items-center q-pt-sm q-px-sm">
    <h6 v-if="msgPesquisando">Pesquisando...</h6>
    <h6 v-if="msgZeroResults">Sem Resultados</h6>
    <q-carousel
      ref="carrosel"
      v-model="slide"
      slide="style"
      swipeable
      animated
      transition-prev="slide-right"
      transition-next="slide-left"
      padding
      height="460px"
      class="q-mb-md"
      @transition="transitioned"
    >
      <q-carousel-slide 
        v-for="pet in petList"
        :key="pet.id"
        :name="pet.id">
        <a @click="$router.push(`/pet?id=${pet.id}`);" >
          <figure class="relative-position">
            <q-icon v-if="pet.loading" 
              class="marked-pet" name="sync" />
            <q-icon v-if="pet.like === 'N'" 
              class="marked-pet"
              color="negative" name="close" />
            <q-icon v-if="pet.like === 'S'" 
              class="marked-pet"
              color="primary" name="done" />
            <img alt="Foto do Perfil"
              class="profile-picture"
              :src="pet.url_foto">
          </figure>
          <h4 class="text-center">{{pet.nome}}</h4>
        </a>
        <article>{{pet.descricao}}</article>
      </q-carousel-slide>
    </q-carousel>
    <div class="buttons flex q-mb-md q-px-sm">
      <q-btn v-if="petList.length > 0"
        @click="dislikePet"
        :disable="blockDislike"
        rounded color="negative" icon="close" />
      <q-btn rounded class="mini" icon="tune" 
        @click="configAberta = true" />
      <q-btn v-if="petList.length > 0"
        @click="likePet"
        :disable="blockLike"
        rounded color="primary" icon="done" />
    </div>
    <q-dialog
      :value="configAberta"
      @hide="configAberta = false"
      >
      <q-card style="width: 700px; max-width: 80vw;">
        <q-card-section>
          <h4>Filtros</h4>
        </q-card-section>
        <q-card-section>
          <q-select
            label="Animal"
            v-bind:value="filtroAnimalExibicao"
            v-on:input="atualizarFiltro('Animal', $event)"
            :options="listaAnimal">
            <template v-slot:option="scope">
              <q-item
                v-bind="scope.itemProps"
                v-on="scope.itemEvents">
                <q-item-section>
                  <q-item-label>
                    {{scope.opt.nome}}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
          <q-select
            label="Raça"
            v-bind:value="filtroRacaExibicao"
            v-on:input="atualizarFiltro('Raca', $event)"
            :options="listaRaca">
            <template v-slot:option="scope">
              <q-item
                v-bind="scope.itemProps"
                v-on="scope.itemEvents">
                <q-item-section>
                  <q-item-label>
                    {{scope.opt.nome}}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
          <q-select
            label="Cor"
            v-bind:value="filtroCorExibicao"
            v-on:input="atualizarFiltro('Cor', $event)"
            :options="listaCor">
            <template v-slot:option="scope">
              <q-item
                v-bind="scope.itemProps"
                v-on="scope.itemEvents">
                <q-item-section>
                  <q-item-label>
                    {{scope.opt.nome}}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
          <q-select
            label="Estado"
            v-bind:value="filtroEstadoExibicao"
            v-on:input="atualizarFiltro('Estado', $event)"
            :options="listaEstado">
            <template v-slot:option="scope">
              <q-item
                v-bind="scope.itemProps"
                v-on="scope.itemEvents">
                <q-item-section>
                  <q-item-label>
                    {{scope.opt.nome}}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
          <q-select
            label="Cidade"
            v-bind:value="filtroCidadeExibicao"
            v-on:input="atualizarFiltro('Cidade', $event)"
            :options="listaCidade">
            <template v-slot:option="scope">
              <q-item
                v-bind="scope.itemProps"
                v-on="scope.itemEvents">
                <q-item-section>
                  <q-item-label>
                    {{scope.opt.nome}}
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
        </q-card-section>
        <q-card-section>
          <q-btn label="Cancelar"
            @click="configAberta = false" />
          <q-btn label="Limpar"
            class="q-ml-md"
            @click="limparFiltros" />
          <q-btn 
            color="primary" label="Filtrar"
            @click="filtrarPets"
            class="float-right" />
        </q-card-section>
      </q-card>
  </q-dialog>
  </div>
</template>

<script>
import { PetService } from '../services/pets'

const markSync = (slide) => (pet) => {
  if (pet.id === slide) {
    pet.loading = true
    pet.like = null
  }
  return pet
}
const markLiked = (slide) => (pet) => {
  if (pet.id === slide) {
    pet.loading = false
    pet.like = 'S'
  }
  return pet
}
const markDisliked = (slide) => (pet) => {
  if (pet.id === slide) {
    pet.loading = false
    pet.like = 'N'
  }
  return pet
}

export default {
  name: 'SearchPet',
  data () {
    return {
      slide: 1,
      msgPesquisando: false,
      msgZeroResults: false,
      configAberta: false,
      blockLike: false,
      blockDislike: false,
      petList: [],
      listaAnimal: [],
      filtroAnimal: null,
      filtroAnimalExibicao: null,
      listaRaca: [],
      filtroRaca: null,
      filtroRacaExibicao: null,
      listaCor: [],
      filtroCor: null,
      filtroCorExibicao: null,
      listaEstado: [],
      filtroEstado: null,
      filtroEstadoExibicao: null,
      listaCidade: [],
      filtroCidade: null,
      filtroCidadeExibicao: null
    }
  },
  mounted () {
    this.msgPesquisando = true
    this.msgZeroResults = false
    PetService.get({
      nao_vinculado: true
    })
      .then(pets => {
        this.msgPesquisando = false
        this.petList = pets
        if (pets.length > 0) {
          this.slide = pets[0].id
        } else {
          this.msgZeroResults = true
        }
      })

    PetService.getCaracteristicas()
      .then(caracteristicas => {
        this.listaAnimal = caracteristicas.animais
        this.listaRaca = caracteristicas.racas
        this.listaCor = caracteristicas.cores
        this.listaEstado = caracteristicas.estados
        this.listaCidade = caracteristicas.cidades
      })
  },
  methods: {
    atualizarFiltro (filtro, valor) {
      this[`filtro${filtro}`] = valor
      this[`filtro${filtro}Exibicao`] = valor.nome
    },
    transitioned () {
      this.blockLike = false
      this.blockDislike = false
      const pet = this.petList.filter(
        (pet) => pet.id === this.slide
      )
      if (pet[0].like === 'S') {
        this.blockLike = true
      }
      if (pet[0].like === 'N') {
        this.blockDislike = true
      }
    },
    likePet () {
      const index = this.slide
      this.petList = this.petList.map(markSync(index))
      PetService.like(index)
        .then((res) => {
          this.petList = this.petList.map(markLiked(index))
        })
      this.$refs.carrosel.next()
    },
    dislikePet () {
      const index = this.slide
      this.petList = this.petList.map(markSync(index))
      PetService.dislike(index)
        .then((res) => {
          this.petList = this.petList.map(markDisliked(index))
        })
      this.$refs.carrosel.next()
    },
    limparFiltros () {
      this.filtroAnimal = null
      this.filtroAnimalExibicao = ''
      this.filtroRaca = null
      this.filtroRacaExibicao = ''
      this.filtroCor = null
      this.filtroCorExibicao = ''
      this.filtroEstado = null
      this.filtroEstadoExibicao = ''
      this.filtroCidade = null
      this.filtroCidadeExibicao = ''
    },
    filtrarPets () {
      this.petList = []
      this.configAberta = false
      this.msgPesquisando = true
      this.msgZeroResults = false
      PetService.get({
        animal: (this.filtroAnimal) ? this.filtroAnimal.id : null,
        raca: (this.filtroRaca) ? this.filtroRaca.id : null,
        cor: (this.filtroCor) ? this.filtroCor.id : null,
        estado: (this.filtroEstado) ? this.filtroEstado.id : null,
        cidade: (this.filtroCidade) ? this.filtroCidade.id : null,
        nao_vinculado: true
      })
        .then(pets => {
          this.msgPesquisando = false
          this.petList = pets
          if (pets.length > 0) {
            this.slide = pets[0].id
          } else {
            this.msgZeroResults = true
          }
        })
    }
  }
}
</script>
<style type="text/css" scoped>
  @keyframes bump {
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
  }
  .q-page-container > div {
    flex-direction: column;
  }
  .q-carousel__slide a {
    cursor: pointer;
  }
  .cover {
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    height: 160px;
    margin-bottom: 50px;
  }
  .marked-pet {
    position: absolute;
    font-size: 50px;
    background: #FFFFFF;
    border: 1px solid #000000;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    margin-top: -45px;
    margin-left: -15px;
    animation: bump 2s linear infinite;
  }
  .marked-pet.text-primary {
    border-color: #528124;
  }
  .marked-pet.text-negative {
    border-color: #C10015;
  }
  .marked-pet.text-negative {
    border-color: #C10015;
  }
  figure {
    margin: 0;
    padding: 0;
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
  h6 {
    margin: 10px 0 0 0;
    color: #528124;
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
    align-items: flex-end;
  }
  .buttons button {
    width: 70px;
    height: 70px;
    font-size: 20px;
    border-radius: 50%;
    font-weight: bold;
  }
  .buttons button.mini {
    width: 40px;
    height: 40px;
    font-size: 15px;
  }
</style>
