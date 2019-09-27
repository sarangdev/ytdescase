<template>
    <NuxtLink class="caseLink" :to="'/cases/'+id">
      <div class="listCase" :id="'case'+id">
          <div class="img" :style="'background-image: url('+img+');'"></div>
          <p>{{ title }}</p>
          <div class="amount"><small>{{ amount }}₽</small><small class="dropped" v-if="amount2 != 0">{{ amount2 }}</small></div>
      </div>
    </NuxtLink>
</template>
<style lang="sass">
.listCase
  //background: rgba(92, 118, 144, 0.45)
  font-size: 21px
  color: white
  //box-shadow: 0 0 27px #00000026
  padding: 1em 2em 1em
  cursor: pointer
  opacity: 0
  display: flex
  align-items: center
  flex-direction: column
  justify-content: center
  margin-right: 71px
  margin-top: 0px
.listCase p
  margin: 0
  padding-top: 10px
  font-size: 25px
  font-weight: 600
a.caseLink
  transition: 0.3s ease-out
a.caseLink:hover
  transform: scale(1.03)
a
  text-decoration: none
  color: black
.img
  width: 173px
  height: 171px
  background-size: cover
  background-repeat: no-repeat
</style>

<script>
export default {
  components: {
      
  },
  data () {
    return {
        cases: [],
        amount2: Math.round(parseFloat(this.amount+(this.amount*.60)))
    }
  },
  mounted () {
    self = this;
    $('.listCase').animate({ opacity: 1, 'margin-top': 10 }, 400);
  },
  props: ['title', 'amount', 'id', 'img'],
  methods: {
  }
}
</script>