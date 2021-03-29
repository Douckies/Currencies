<template>
<v-app>
  <v-row>
      <v-col
      md=2
      >
        <v-navigation-drawer
        permanent
        expand-on-hover
        >
          <v-list>
            <v-list-item class="px-2">
              <v-list-item-avatar>
                <v-img center src="@/assets/btc.jpg"></v-img>
              </v-list-item-avatar>
            </v-list-item>
          </v-list>

          <v-list
            nav
            dense
          >
            <v-list-item link
              v-for='link in links'
              :key='link.id'
              :to='link.url'
            >
              <v-list-item-icon>
                <v-icon>{{link.mdi}}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{link.name}}</v-list-item-title>
            </v-list-item>
                  
            <v-divider></v-divider>
          </v-list>
              
        </v-navigation-drawer>  
              
      </v-col>

      <v-col>
        <div style='margin-top: 32px; width: 85%'>
          <p class='text-center'> Crypto currencies wallet management </p>
          <v-divider style='margin-bottom: 20px'></v-divider>
          <router-view></router-view>
        </div>
      </v-col>
  </v-row>
</v-app>
</template>

<script>
import { EventBus } from "@/eventBus.js";
import { mapGetters } from 'vuex'
//import investExchangeForm from './components/investExchangeForm.vue'

export default {
  components: {
    //investExchangeForm
  },

  data() {
    return {
      size: 1,
      pannel: 10, 
      timestamp: "",
      links: [
        {id: 3, name:'Home', url:'/', mdi: 'mdi-home'},
        {id: 0, name:'List', url: '/list', mdi: 'mdi-format-list-bulleted'},
        {id: 1, name:'Operations', url: '/operations', mdi: 'mdi-plus'},
      ],

      snackBarColor: "error",
      snackBarText: "I don't have any message for you :(",
      displaySnackBar: false
    }
  },
  
  created() {
    this.$store.dispatch('get_investment')
    this.$store.dispatch('get_currencies_owned')
    this.$store.dispatch('get_gecko_coins_information')

    EventBus.$on("showSnackBar", data => {
      this.displaySnackBar = true;
      this.snackBarColor = data.color;
      this.snackBarText = data.message;
    });
  },

  computed: {
    ...mapGetters({
      currencies: 'getCurrenciesOwned',
    }),
  }
}

</script>

<style scoped>
  .snackbar {
    text-align: center
  }
</style>