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
      <q-btn rounded class="mini" icon="settings" 
        @click="configAberta = true" />
      <q-btn rounded color="primary" icon="done" />
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
          <q-btn 
            color="primary" label="Filtrar"
            class="float-right" />
        </q-card-section>
      </q-card>
  </q-dialog>
  </div>
</template>

<script>
import { PetService } from 'services/pets';

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
const animais = [
  {
    id: 1,
    nome: 'Gato'
  },
  {
    id: 2,
    nome: 'Cachorro'
  }
]
const racas = [
  {
    id: 1,
    nome: 'Yorkshire',
    idAnimal: 2
  },
  {
    id: 2,
    nome: 'Persa',
    idAnimal: 1
  }
]
const cores = [
  {
    id: 1,
    nome: 'Amarelo'
  },
  {
    id: 2,
    nome: 'Preto'
  }
]
const estados = [
  {
    id: 1,
    nome: 'RS'
  },
  {
    id: 2,
    nome: 'SC'
  }
]
const cidades = [
  {
    id: 1,
    nome: 'Novo Hamburgo'
  },
  {
    id: 2,
    nome: 'São Leopoldo'
  }
]

export default {
  name: 'SearchPet',
  data () {
    return {
      slide: 1,
      configAberta: false,
      petList: pets,
      listaAnimal: animais,
      filtroAnimal: null,
      filtroAnimalExibicao: null,
      listaRaca: racas,
      filtroRaca: null,
      filtroRacaExibicao: null,
      listaCor: cores,
      filtroCor: null,
      filtroCorExibicao: null,
      listaEstado: estados,
      filtroEstado: null,
      filtroEstadoExibicao: null,
      listaCidade: cidades,
      filtroCidade: null,
      filtroCidadeExibicao: null
    }
  },
  mounted () {
    PetService.getPets()
      .then(pets => {
        this.petList = pets;
      });
  },
  methods: {
    atualizarFiltro (filtro, valor) {
      this[`filtro${filtro}`] = valor
      this[`filtro${filtro}Exibicao`] = valor.nome
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
