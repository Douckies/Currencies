<template>
<v-app>
  <v-card class="overflow-hidden">
    <v-app-bar
      absolute
      color="#6A76AB"
      dark
      shrink-on-scroll
      prominent
      src="@/assets/cryptomonnaies.jpg"
      fade-img-on-scroll
      scroll-target="#scrolling-techniques-3"
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-app-bar-title>Cryptos</v-app-bar-title>

      <template v-slot:extension>
        <v-tabs align-with-title>
          <v-tab
          v-for='link in links'
          :key='link.id'
          :to='link.url'
          >
            {{link.nom}}
          </v-tab>
        </v-tabs>
      </template>
    </v-app-bar>
    <v-sheet 
    min-height=600px
    style="margin-top: 230px; margin-left: 50px; margin-right: 50px"
    >
      <v-row justify='start'>
        <v-col>
          <router-view></router-view>
        </v-col>
      </v-row>
    </v-sheet>
  </v-card>


</v-app>
</template>

<script>
export default {
  data() {
    return {
      links: [
        {id: 3, nom:'Home', url:'/'},
        {id: 0, nom:'Liste', url: '/liste'},
        {id: 1, nom:'Achat', url: '/achat'},
        {id: 2, nom:'Vente', url: '/vente'},
      ]
    }
  },

  created() {
    this.$store.dispatch('get_apport')
    this.$store.dispatch('get_crypto')
  }
}
</script>