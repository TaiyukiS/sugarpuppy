<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />
        <q-toolbar-title class="cursor-pointer" @click="$router.push('/timeline')">
          Suggar Puppy
        </q-toolbar-title>
        <div>{{login.nome}}</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <q-item v-ripple>
          <q-item-section avatar>
            <q-avatar>
              <img :src="login.url">
            </q-avatar>
          </q-item-section>
          <q-item-section>{{login.nome}}</q-item-section>
        </q-item>
        <q-separator />
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-dialog
      :value="show_pet_dialog"
      @input="fecharPetDialog()"
    >
      <q-card style="width: 480px; max-width: 80vw;">
        <q-card-section>
          <q-select
            label="Usar app como Pet"
            v-bind:value="petSelecionadoExibicao"
            v-on:input="atualizarPetSelect($event)"
            :options="listaPets">
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
        <q-card-actions class="flex justify-evenly">
          <q-btn
            unelevated
            @click="fecharPetDialog"
            label="Cancelar"
          />
          <q-btn
            unelevated
            color="primary"
            @click="usarPet"
            label="Usar Selecionado"
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-layout>
</template>

<script>
import LocalStorage from '../services/LocalStorage'
import { LoginService } from '../services/login'
import EssentialLink from 'components/EssentialLink.vue'

let ispet = Boolean(LocalStorage.get('ispet'))

const constructMenu = (ispet) => [
  {
    title: 'Início',
    icon: 'home',
    link: '#/timeline',
    visible: true
  },
  {
    title: 'Pesquisar',
    icon: 'search',
    link: '#/search',
    visible: !ispet
  },  
  {
    title: 'Meus Pets',
    icon: 'pets',
    link: '#/my-pets',
    visible: !ispet
  },
  {
    title: 'Usar como Pet',
    icon: 'swap_vert',
    click: 'changeToPet',
    visible: !ispet
  },
  {
    title: 'Usar como Usuário',
    icon: 'swap_vert',
    click: 'changeToUser',
    visible: ispet
  },
  {
    title: 'Sair',
    icon: 'power_settings_new',
    link: '#/logout'
  }
]

export default {
  name: 'MainLayout',
  components: { EssentialLink },
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: constructMenu(ispet),
      login: LocalStorage.get('login'),
      show_pet_dialog: false,
      listaPets: LocalStorage.get('pets'),
      petSelecionado: null,
      petSelecionadoExibicao: null
    }
  },
  beforeCreate () {
    if (!LocalStorage.get('login')) {
      this.$router.push('/')
    }
  },
  created () {
    this.$root.$on('changeToPet', this.changeToPet)
    this.$root.$on('changeToUser', this.changeToUser)
  },
  methods: {
    fecharPetDialog () {
      this.show_pet_dialog = false
    },
    changeToPet () {
      this.leftDrawerOpen = false
      if (this.listaPets.length > 0) {
        this.show_pet_dialog = true
      } else {
        this.$q.notify({
          message: 'Você não tem nenhum pet',
          color: 'info'
        })
      }
    },
    atualizarPetSelect (value) {
      this.petSelecionado = value
      this.petSelecionadoExibicao = value.nome
    },
    usarPet () {
      this.leftDrawerOpen = false
      ispet = true
      LoginService.iamPet(this.petSelecionado)
      this.essentialLinks = constructMenu(ispet)
      this.login = LocalStorage.get('login')
      this.$router.go()
    },
    changeToUser () {
      ispet = false
      this.petSelecionado = null
      this.petSelecionadoExibicao = null
      LoginService.iamUSer()
      this.essentialLinks = constructMenu(ispet)
      this.login = LocalStorage.get('login')
      this.$router.go()
    }
  }
}
</script>
<style type="text/css" scoped>
  h4 {
    margin: 0;
    color: #528124;
    font-size: 25px;
    text-align: center;
  }
</style>
