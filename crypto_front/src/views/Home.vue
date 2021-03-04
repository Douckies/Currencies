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
              Investment
            </v-list-item-title>
            <div class="overline mb-4">
              Total investment : {{totalInvestment}}€. <br/>
              Actually {{currenciesOwned.length}} different currencies owned. <br/>
            </div>
          </v-list-item-content>
        </v-list-item>
      </v-row>
      
      <v-row>
        <v-col v-for='(exchangeHome, index) in investmentByExchange'
        :key='exchangeHome.plateforme'
        >
          <cryptoCard :exchangeCardProp='exchangeHome' 
            :currenciesCardProp='currenciesByExchange[index]' 
            @click.native="$router.push({ name: 'Exchange', params: { selectedExchange: exchangeHome, exchangeCurrencies: currenciesByExchange[index] } })"
          />
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <displayHistory/>
        </v-col>
      </v-row>
      </v-card>
    </v-col>
  </v-row>
</v-app>
</template>

<script>
// @ is an alias to /src
import { mapGetters } from 'vuex'
import cryptoCard from '@/components/cryptoCard.vue'
import displayHistory from '@/components/displayHistory.vue'

export default {
  name: "Home",
  components: {
    cryptoCard,
    displayHistory
  },

  data() {
    return {
      totalInvestment: 0,
      currenciesByExchange: []
    }
  },

  computed: {
    ...mapGetters({
      investmentByExchange: 'getTotalInvestment',
      historyList: 'getHistory',

      currenciesOwned: 'getCurrenciesOwned',

      cryptoBinance: 'getCurrenciesExchangeBinance',
      cryptoCryptoCom: 'getCurrenciesExchangeCryptoCom',
      cryptoSwissborg: 'getCurrenciesExchangeSwissborg'
    }) 
  },
  methods: {
    computeTotalInvestment() {
      for(let i = 0; i<this.investmentByExchange.length; i++) {
        this.totalInvestment += Number(this.investmentByExchange[i].apport, 10)
      }
    },            
  },

  async created() {
    await this.$store.dispatch('get_investment')
    await this.$store.dispatch('get_history')

    this.computeTotalInvestment()

    this.currenciesByExchange.push(this.cryptoBinance)
    this.currenciesByExchange.push(this.cryptoSwissborg)
    this.currenciesByExchange.push(this.cryptoCryptoCom)
  }
};
</script>
,