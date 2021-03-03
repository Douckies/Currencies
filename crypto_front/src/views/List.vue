<template>
<v-app>
  <v-row>
    <v-col>
      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="currenciesOwned"
          :search="search"
        >
        </v-data-table>
      </v-card>
    </v-col>
  </v-row>
</v-app>
</template>

<script>
// @ is an alias to /src
import { mapGetters } from 'vuex'

export default {
  name: "List",
  data() {
    return {
      search: '',
      headers: [
        {
          text: 'Exchange',
          align: 'start',
          value: 'plateforme',
        },
        { text: 'Currency', value: 'nom' },
        { text: 'Owned quantity', value: 'qtt' },
        { text: 'Investment', value: 'investissement' },
        //{ text: 'Benefice ($)', value: 'benefice' },
        //{ text: 'Cours actuel', value: 'ADETERMINER' },
      ],
    }
  },

  computed: {
    ...mapGetters({
      currenciesOwned: 'getCurrenciesOwned'
    }) 
  },

  created() {
    this.$store.dispatch('get_currencies_owned')
  }
};
</script>
