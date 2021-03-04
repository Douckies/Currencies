<template>
      <v-card>
        <v-card-text>
          <v-text-field
            v-model='investInExchange.exchange'
            label="Exchange"
            placeholder="Binance"
            required
          ></v-text-field>
          <v-text-field
            v-model='investInExchange.quantityToBuy'
            label="Value (€)"
            placeholder="500"
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
        investInExchange: {}
      }
    },

    methods: {
      submit() {
        this.investInExchange.currencyToBuy = 'USD'
        this.investInExchange.investment = this.investInExchange.quantityToBuy
        this.$store.dispatch('post_investment', this.investInExchange)
        this.$store.dispatch('post_orderCurrency', this.investInExchange)
        this.$store.dispatch('post_history', this.investInExchange)
      }
    },
}
</script>