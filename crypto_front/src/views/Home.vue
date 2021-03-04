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
        <v-col v-for='exchangeHome in investmentByExchange'
        :key='exchangeHome.plateforme'
        >
          <cryptoCard :exchangeCardProp='exchangeHome' 
            :currenciesCardProp='currenciesOwned.filter(exchange => exchange.plateforme === exchangeHome.plateforme)' 
            @click.native="$router.push({ name: 'Exchange', params: { selectedExchange: exchangeHome, exchangeCurrencies: currenciesOwned.filter(exchange => exchange.plateforme === exchangeHome.plateforme) } })"
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
      currenciesOwned: 'getCurrenciesOwned',
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
    this.computeTotalInvestment()
  }
};
</script>