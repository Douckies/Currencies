<template>
<v-app>
  <p> {{cryptos}} </p>
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
          :items="cryptos"
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
  name: "Liste",
  data() {
    return {
      search: '',
      headers: [
        {
          text: 'Plateforme',
          align: 'start',
          value: 'plateforme',
        },
        { text: 'Crypto currency', value: 'nom' },
        { text: 'Quantité possédée', value: 'qtt' },
        { text: 'Investissement ($)', value: 'investissement' },
        { text: 'Bénéfice ($)', value: 'benefice' },
        //{ text: 'Cours actuel', value: 'ADETERMINER' },
      ],
    }
  },

  computed: {
    ...mapGetters({
      cryptos: 'getCryptos'
    }) 
  },

  created() {
    this.$store.dispatch('get_crypto')
  }
};
</script>
