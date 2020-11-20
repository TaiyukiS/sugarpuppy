<template>
  <div id="login" class="flex justify-center items-center">
    <h4>Bem-vindo ao Suggar Puppy</h4>
    <q-form @submit="doLogin">
      <q-input
        rounded outlined v-model="login" label="Login" 
        @keydown.enter="doLogin" />
      <q-input class="q-my-sm" type="password"
        rounded outlined v-model="senha" label="Senha"
        @keydown.enter="doLogin" />
      <q-btn class="q-mt-sm"
        rounded color="primary" label="Entrar" 
        @click="doLogin" />
    </q-form>
  </div>
</template>

<script>
import LocalStorage from '../services/LocalStorage'
import { LoginService } from '../services/login'
import { PetService } from '../services/pets'

export default {
  name: 'Login',
  data () {
    return {
      login: '',
      senha: ''
    }
  },
  beforeCreate () {
    if (LocalStorage.get('login')) {
      this.$router.push('/timeline')
    }
  },
  methods: {
    async doLogin () {
      if (this.login.length === 0 || this.senha.length === 0) {
        this.$q.notify({
          message: 'Preencha os campos Login e Senha!',
          color: 'negative'
        })
        return
      }
      const dismiss = this.$q.notify({
        message: 'Processando...'
      })
      try {
        await LoginService.login(this.login, this.senha)
        await PetService.getMeus()
        dismiss()
        this.$q.notify({
          message: 'Sucesso!',
          color: 'primary'
        })
        this.$router.push('/timeline')
      } catch (e) {
        dismiss()
        this.$q.notify({
          message: 'Ops! não foi possível fazer o login',
          color: 'negative'
        })
      }
    }
  }
}
</script>
<style type="text/css" scoped>
  #login {
    padding: 90px 20px;
  }
  .q-page-container > div {
    flex-direction: column;
  }
  .profile-picture {
    width: 150px;
    height: 150px;
    border: 2px solid #528124;
    border-radius: 50%;
  }
  h4 {
    font-size: 20px;
    color: #528124;
    margin: 10px 0;
  }
  form {
    width: 100%;
    text-align: center;
  }
</style>
