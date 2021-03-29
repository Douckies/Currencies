<template>
  <v-app>

        <v-card>
          <v-card-text>
            <v-select
                v-model="currencyToSell.exchange"
                :items="exchanges"
                label="Exchange"
                :rules='exchangeRules'
            ></v-select>

            <v-select
                v-model="currencyToSell.currencyToSell"
                :items="currenciesNameByExchange"
                label="Currency to sell"
                :rules='nameRules'
            ></v-select>

            <v-text-field
                v-model.number="currencyToSell.quantityToSell"
                label="Quantity of currency to sell"
                placeholder="500"
                :rules='numberRules'
                required clearable
            ></v-text-field>

            <v-text-field
                v-model="currencyToSell.currencyToBuy"
                label="Currency to exchange with"
                placeholder="BTC"
                :rules='nameRules'
                required clearable
            ></v-text-field>

            <v-text-field
                v-model.number="currencyToSell.quantityToBuy"
                label="Quantity of currency to exchange"
                placeholder="40"
                :rules='numberRules'
                required clearable
            ></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer/>
            <v-btn
              color="primary"
              type="submit"
              text
              @click="submit"
            >
              Submit
            </v-btn>
          </v-card-actions>
        </v-card>
  </v-app>
</template>

<script>
import { mapGetters } from 'vuex'

  export default {
    data() {
      return {
        currencyToSell: {},

        exchangeRules: [
          v => !!v || 'You need to tell us which exchange will be used !',
        ],

        nameRules: [
          v => !!v || 'We need to know the chosen currency',
          v => (v && v.length >= 3) || 'The currency name does not look to be valid (atleast 3 letters required)',
        ],

        numberRules: [
          v => !!v || 'We need to know how much',
          v => !isNaN(v) || 'You need to put a number here !',
          v => v >= 0 || 'This value cannot be negative'
        ],
      }
    },

    computed: {
      ...mapGetters({
        exchanges: 'getExchanges',
      }),

      currenciesNameByExchange() {
        return this.$store.getters.getCurrenciesNameByExchange(this.currencyToSell.exchange)
      }
    },

    methods: {
      submit() {
        if(!this.currencyToSell.investment) {
          this.currencyToSell.investment = 0
        }
        this.$store.dispatch('post_orderCurrency', this.currencyToSell)
        this.currencyToSell.operation = 'sell'
        this.$store.dispatch('post_history', this.currencyToSell)
      }
    },
  }
</script>