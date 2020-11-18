<template>
  <div id="login" class="flex justify-center items-center">
    <img alt="Foto do Perfil"
      class="profile-picture"
      src="~assets/ehmole.jpg">
    <h4>Bem-vinda Cláudia</h4>
    <form>
      <q-input
        rounded outlined v-model="login" label="Login" />
      <q-input class="q-my-sm" type="password"
        rounded outlined v-model="senha" label="Senha" />
      <q-btn class="q-mt-sm"
        rounded color="primary" label="Entrar" 
        @click="doLogin" />
    </form>
  </div>
</template>

<script>
import loginService from '../services/login'
export default {
  name: 'Login',
  data () {
    return {
      login: null,
      senha: null
    }
  },
  methods: {
    async doLogin (){
      await loginService.login (this.login, this.senha)
      this.$router.push('/timeline');
    }
  }
}
</script>
<style type="text/css" scoped>
  #login {
    padding: 40px 20px;
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
