<template>
  <div class="fullscreen text-white text-center q-pa-md flex flex-center">
    <div>
      <h1 class="text-primary">Oops!</h1>
      <h3 class="text-primary">
        Não foi possível encontrar o que você procura.
      </h3>
      <q-btn class="q-mt-sm"
        @click="$router.back();"
        rounded color="primary" label="Voltar" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Error404'
}
</script>
<style type="text/css" scoped>
  h1 {
    font-size: 100px;
  }
  h3 {
    font-size: 50px;
    opacity: 0.5;
  }
  button {
    width: 200px;
    margin: 20px 0 0 0;
    font-size: 20px;
  }
</style>
