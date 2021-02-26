<template> 
<v-app>
  <v-row>
    <v-col>
      <v-card
        class="mx-auto"
        outlined
      >
      <v-row>
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-title class="headline mb-1">
              Investissement
            </v-list-item-title>
            <div class="overline mb-4">
              Investissement total : {{apportTotal}}€. <br/>
              Actuellement {{cryptos.length}} cryptos différentes dans le portefeuille. <br/>
            </div>
          </v-list-item-content>
        </v-list-item>
      </v-row>

      <v-row>
        <v-col v-for='(plateforme, index) in apport'
        :key='plateforme.plateforme'
        >
          <cryptoCard :plateforme='plateforme' 
            :crypto='crypto[index]' 
            @click.native="$router.push({ name: 'plateforme', params: { plateforme: plateforme, crypto: crypto[index] } })"
          />
        </v-col>
      </v-row>
      </v-card>
    </v-col>
    <p> {{crypto}} </p>
  </v-row>
</v-app>
</template>

<script>
// @ is an alias to /src
import { mapGetters } from 'vuex'
import cryptoCard from '@/components/cryptoCard.vue'

export default {
  name: "Home",
  components: {
    cryptoCard
  },

  data() {
    return {
      apportTotal: 0,
      crypto: []
    }
  },

  computed: {
    ...mapGetters({
      apport: 'getApport',
      cryptos: 'getCryptos',
      cryptoBinance: 'getCryptoBinance',
      cryptoCryptoCom: 'getCryptoCryptoCom',
      cryptoSwissborg: 'getCryptoSwissborg'
    }) 
  },

  methods: {
    calculInvestissementTotal() {
      for(let i = 0; i<this.apport.length; i++) {
        this.apportTotal += Number(this.apport[i].apport, 10)
      }
    },

    toPlateforme() {
      console.log('click')
      
    }
  },

  async created() {
    await this.$store.dispatch('get_apport')
    this.calculInvestissementTotal()
    this.crypto.push(this.cryptoBinance)
    this.crypto.push(this.cryptoSwissborg)
    this.crypto.push(this.cryptoCryptoCom)
    console.log(this.crypto[0])
  }
};
</script>
,