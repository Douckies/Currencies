<template>
  <v-app>
    <div class='buttons'>
      <v-row>
        <v-col
        md=3
        v-for='operation in operations'
        :key='operation.id'>
          <v-btn class="button" plain 
          @click='selection = operation.action'
          >
            {{operation.name}}
          </v-btn>
        </v-col>
      </v-row>
    </div>
    
    <div class='field'>
      <v-row>
        <v-spacer></v-spacer>
        <v-col md=7>
          <div v-if='selection === "buy"'>
            <buyCurrencyForm/>
          </div>

          <div v-if='selection === "invest"'>
            <investExchangeForm/>
          </div>

          <div v-if='selection === "sell"'>
            <sellCurrency/>
          </div>
        </v-col>
        <v-spacer></v-spacer>
      </v-row>
    </div>
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
        selection: "",
        operations: [
          {id: 0, name: "Invest", action: "invest"},
          {id: 1, name: "Buy", action: "buy"},
          {id: 2, name: "Sell", action: "sell"}
        ],
      }
    },

    created() {
      this.$store.dispatch('get_currencies_owned')
    },
  }
</script>

<style scoped>
.buttons {
  margin-left: 25%
}
.field {
  margin-top: 25px
}
.button {
  text-align: center;
  width: 100px
}
</style>