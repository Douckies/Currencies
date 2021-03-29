<template>
      <v-card>
        <v-card-text>
          <v-text-field
            v-model='investInExchange.exchange'
            label="Exchange"
            placeholder="Binance"
            :rules='exchangeRules'
            required
          ></v-text-field>
          <v-text-field
            v-model='investInExchange.quantityToBuy'
            label="Value ($)"
            placeholder="500"
            :rules="investRules"
            required 
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

export default {

    data() {
      return {
        investInExchange: {},

        exchangeRules: [
          v => !!v || 'You need to tell us which exchange will be top up !',
        ],

        investRules: [
          v => !!v || 'How much will you invest in this exchange ?',
          v => !isNaN(v) || 'You need to put a number here !',
          v => v >= 0 || 'Cannot top up a negative value bud'
        ],
      }
    },

    methods: {
      submit() {
        this.investInExchange.currencyToBuy = 'USD'
        this.investInExchange.investment = this.investInExchange.quantityToBuy
        this.$store.dispatch('post_investment', this.investInExchange)
        this.$store.dispatch('post_orderCurrency', this.investInExchange)
      }
    },
}
</script>