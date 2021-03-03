<template>
  <v-app>
    <v-row>
      <v-col>
        <v-card>
          <v-card-text>
            <v-select
                v-model="currencyToSell.exchange"
                :items="exchanges"
                label="Exchange"
            ></v-select>

            <v-select
                v-model="currencyToSell.currencyToSell"
                :items="currenciesNameByExchange"
                label="Currency to sell"
            ></v-select>

            <v-text-field
                v-model.number="currencyToSell.quantityToSell"
                label="Quantity of currency to sell"
                placeholder="500"
                required clearable
            ></v-text-field>

            <v-text-field
                v-model="currencyToSell.currencyToBuy"
                label="Currency to exchange with"
                placeholder="BTC"
                required clearable
            ></v-text-field>

            <v-text-field
                v-model.number="currencyToSell.quantityToBuy"
                label="Quantity of currency to exchange"
                placeholder="40"
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
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import { mapGetters } from 'vuex'

  export default {
    data() {
      return {
        currencyToSell: {}
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
        this.$store.dispatch('post_sellCurrency', this.currencyToSell.exchange)
      }
    },
  }
</script>