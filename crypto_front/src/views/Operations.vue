<template>
  <v-app>
    <v-row>
      <v-spacer/>
      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='investInExchange = true; buyCurrency = false; sellCurrency = false'>
          Invest in Exchange
        </v-btn>
      </v-col>

      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='buyCurrency = true; investInExchange = false; sellCurrency = false'>
          Buy currency
        </v-btn>
      </v-col>

      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='sellCurrency = true; investInExchange = false; buyCurrency = false'>
          Sell currency
        </v-btn>
      </v-col>
      <v-spacer/>
    </v-row>

    <v-row>
      <v-spacer/>
      <v-col>
        <div v-if='buyCurrency'>
          <buyCurrencyForm/>
        </div>

        <div v-if='investInExchange'>
          <investExchangeForm/>
        </div>

        <div v-if='sellCurrency'>
          <sellCurrency/>
        </div>
      </v-col>
      <v-spacer/>
    </v-row>
  </v-app>
</template>

<script>
import buyCurrencyForm from '@/components/buyCurrencyForm.vue'
import sellCurrency from '@/components/sellCurrencyForm.vue'
import investExchangeForm from '@/components/investExchangeForm.vue'

  export default {
    components: {
      buyCurrencyForm,
      investExchangeForm,
      sellCurrency
    },

    data() {
      return {
        buyCurrency: false,
        investInExchange: false,
        sellCurrency: false
      }
    },

    created() {
      this.$store.dispatch('get_currencies_owned')
    },
  }
</script>