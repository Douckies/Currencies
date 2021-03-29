<template>
<v-app>
  <v-row>
    <v-col>
      <list :currencies='currenciesOwned'/>
    </v-col>
  </v-row>
</v-app>
</template>

<script>
// @ is an alias to /src
import { mapGetters } from 'vuex'
import list from '@/components/listing.vue'

export default {
  name: "List",
  components: {
    list
  },

  computed: {
    ...mapGetters({
      currenciesOwned: 'getCurrenciesOwned',
    }) 
  },

  created() {
    this.$store.dispatch('get_currencies_owned')
  }
};
</script>
