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
export default {
  name: 'Logout',
  mounted () {
    const that = this
    setTimeout(() => {
      that.$router.push('/')
    }, 2000)
  }
}
</script>
<style type="text/css" scoped>
  h3 {
    font-size: 50px;
  }
</style>
