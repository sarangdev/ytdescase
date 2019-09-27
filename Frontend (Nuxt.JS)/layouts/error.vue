<template>
  <div class="container ss">
    <h1 v-if="error.statusCode === 404">Страница не найдена</h1>
    <h1 v-else>Произошла ошибка</h1>
  </div>
</template>

<script>
export default {
  props: ['error']
}
</script>
<style lang="sass">
  .container.ss h1
    text-align: center
    padding-top: 20px
    padding-bottom: 20px
    color: white
</style>