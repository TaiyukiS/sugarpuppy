<template>
  <div class="fullscreen text-white text-center q-pa-md flex flex-center">
    <div>
      <h3 class="text-primary">
        Desconectando...
      </h3>
    </div>
  </div>
</template>

<script>
import { LoginService } from '../services/login'
export default {
  name: 'Logout',
  mounted () {
    LoginService.logoff()
    this.$router.push('/')
  }
}
</script>
<style type="text/css" scoped>
  h3 {
    font-size: 50px;
  }
</style>
