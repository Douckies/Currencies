<template> 
<v-app>
  <v-row>
    <v-col>
      <v-row>
        <v-col>
          <v-card flat tile class="data">
            <div style="text-align: center">
              <v-icon x-large color=green class="mdi mdi-currency-usd" style="margin-bottom: 15px"/> <br/>
              <span class="computeddata"> {{totalInvestment.toFixed(2)}} $</span>
              <v-card-subtitle> Invested </v-card-subtitle>
            </div>
          </v-card>
        </v-col>

        <v-divider vertical></v-divider>

        <v-col>
          <v-card flat tile class="data">
            <div style="text-align: center">
              <v-icon x-large color=green class="mdi mdi-currency-btc" style="margin-bottom: 15px"/> <br/>
              <span class="computeddata">{{numberCurrenciesOwned}}</span>
              <v-card-subtitle> Different currencies owned </v-card-subtitle>
            </div>
          </v-card>
        </v-col>

        <v-divider vertical></v-divider>

        <v-col>
          <v-card flat tile class="data">
            <div style="text-align: center">
              <v-icon x-large color=green class="mdi mdi-bank" style="margin-bottom: 15px"/> <br/>
              <span class="computeddata">{{computeTotalBenefits.toFixed(2)}} $</span>
              <v-card-subtitle> Benefices in currencies <br/>
               (Pay yourself !) </v-card-subtitle>
            </div>
          </v-card>
        </v-col>

        <v-divider vertical></v-divider>

        <v-col>
          <v-card flat tile class="data">
            <div style="text-align: center">
              <v-icon x-large color=green class="mdi mdi-safe-square-outline" style="margin-bottom: 15px"/> <br/>
              <span class="computeddata">{{computeTotalUSDT.toFixed(2)}} USDT</span>
              <v-card-subtitle> Owned on exchanges </v-card-subtitle>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-divider style='margin-top: 50px'></v-divider>
      </v-row>
      
      <v-row style='margin-top: 50px'>
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
      datas: [],
      totalInvestment: 0,
      totalUSDOwned: 0,
      numberCurrenciesOwned: 0,
      currenciesByExchange: []
    }
  },

  computed: {
    ...mapGetters({
      investmentByExchange: 'getTotalInvestment',
      currenciesOwned: 'getCurrenciesOwned',
    }),

    computeTotalUSDT() {
      let totalUSDT = 0
      
      for(let i = 0; i<this.investmentByExchange.length; i++) {
        totalUSDT += Number(this.$store.getters.getUSDByExchange(this.investmentByExchange[i].plateforme))
      }

      return totalUSDT
    },

    computeTotalBenefits() {
      let totalProvisionnalBenefits = 0

      for(let i = 0; i<this.currenciesOwned.length; i++) {
        totalProvisionnalBenefits += Number(this.currenciesOwned[i].actualBenefits)
      }

      return totalProvisionnalBenefits
    }
  },
  methods: {
    computeTotalInvestment() {
      for(let i = 0; i<this.investmentByExchange.length; i++) {
        this.totalInvestment += Number(this.investmentByExchange[i].apport, 10)
      }
    },

    countCurrenciesOwned() {
      let tmp = []
      let modification = true

      for(let i=0; i<this.currenciesOwned.length; i++) {
        for (let j=0; j<tmp.length; j++) {
          console.log("i : ", i, this.currenciesOwned[i].nom)
          console.log("j : ", j, tmp[j])
          if (tmp[j] === this.currenciesOwned[i].nom) {
            modification = false
          } 
        }
        if(modification) {
          tmp.push(this.currenciesOwned[i].nom)
        }
        modification = true
      }

      this.numberCurrenciesOwned = tmp.length
    }
  },

  async created() {
    await this.$store.dispatch('get_investment')
    this.computeTotalInvestment()
    this.countCurrenciesOwned()
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');

.data {
  background-color: white;
  height: 100px;
}

.computeddata {
  font-family: 'Work Sans', sans-serif;
}
</style>