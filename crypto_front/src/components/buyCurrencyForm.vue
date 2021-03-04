<template>
      <v-card>
        <v-card-text>
          <v-select
            v-model="currencyToBuy.exchange"
            :items="exchanges"
            label="Exchange"
          ></v-select>

          <v-text-field
            v-model="currencyToBuy.currencyToBuy"
            label="Name of the currency to buy"
            placeholder="BTC"
            required clearable
          ></v-text-field>

          <v-text-field
            v-model="currencyToBuy.quantityToBuy"
            label="Quantity of the currency to buy"
            placeholder="10"
            required clearable
          ></v-text-field>

          <v-select
            v-model="currencyToBuy.currencyToSell"
            :items="currenciesNameByExchange"
            label="Currency to buy with"
          ></v-select>

          <v-text-field
            v-model="currencyToBuy.quantityToSell"
            label="Quantity of currency to exchange"
            placeholder="250"
            required clearable
          ></v-text-field>

        </v-card-text>
        <v-divider class="mt-2"></v-divider>
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
</template>

<script>
//import apiCalls from '@/service/apiCalls.js'
import { mapGetters } from 'vuex'

  export default {
    data: () => ({
      currencyToBuy: {},
    }),

    methods: {
      async submit () {
        if(!this.currencyToBuy.investment) {
          this.currencyToBuy.investment = 0
        }
        this.$store.dispatch('post_orderCurrency', this.currencyToBuy)

        this.currencyToBuy.operation = 'buy'
        this.$store.dispatch('post_history', this.currencyToBuy)
      },
    },

    computed: {
      ...mapGetters({
        exchanges: 'getExchanges',
      }),

      currenciesNameByExchange() {
        return this.$store.getters.getCurrenciesNameByExchange(this.currencyToBuy.exchange)
      }
    },
  }
</script>