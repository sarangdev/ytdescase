<template>
  <div>
      <Header />
      <nuxt/>
      <Footer />
  </div>
</template>
<script>
import Header from "~/components/Header.vue";
import Footer from "~/components/Footer.vue";

export default {
  components: {
    Header,
    Footer
  }
};
</script>
<style lang="sass">
body, html
  //background-image: url(/bg.jpg)
</style>