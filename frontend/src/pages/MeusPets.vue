<template>
  <q-page>
    <div class="q-pa-md">
      <q-toolbar class="bg-secondary text-white shadow-2">
        <q-toolbar-title>Meus Pets</q-toolbar-title>
      </q-toolbar>
      <q-list bordered>
        <q-item v-for="pet in pets" :key="pet.id" clickable v-ripple @click="$router.push(`/pet?id=${pet.id}`);">
          <q-item-section avatar>
            <q-avatar>
              <img src="https://picsum.photos/400/400" alt="avatar-pet"/>
            </q-avatar>
          </q-item-section>
          <q-item-section>{{pet.nome}}</q-item-section>
        </q-item>
        
        <q-inner-loading :showing="loading">
            <q-spinner-gears size="50px" color="primary" />
        </q-inner-loading>

      </q-list>
    </div>
  </q-page>
</template>

<script>
import { PetService } from '../services/pets'
export default {
  name: 'MeuPets',
  data () {
    return {
      pets: [],
      loading: false
    }
  },
  mounted () {
    this.buscarMeusPet()
  },
  methods: {
    buscarMeusPet () {
      this.loading = true
      PetService.getMeus()
        .then(pets => {
          this.pets = pets
        })
        .catch(() => {
          this.$q.notify({
            message: 'Ops! Houve algum erro',
            color: 'negative'
          })
        })
        .finally(() => {
          this.loading = false
        })
    }
  }
}
</script>
<style type="text/css" scoped>
</style>
