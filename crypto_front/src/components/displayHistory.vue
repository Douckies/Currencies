<template>
    <v-app>
        <v-card v-if='historyList.length > 0'>
            <v-card-text>
                <div class="overline mb-4">
                    History
                </div>

                <v-timeline
                align-top
                dense
                >
                    <div v-if="!showAll">
                        <div v-for="(history, index) in historyList"
                        :key="history.id">
                            <v-timeline-item
                            color="blue"
                            small
                            v-if="index <= 5"
                            >
                                <div>
                                    <div class="font-weight-normal" v-if="history.operation === 'buy'">
                                        <strong> @ {{history.date}} - {{ history.exchange }} </strong> :
                                        Bought {{ history.boughtCurrencyQtt }} {{ history.boughtCurrency }} with {{ history.soldCurrencyQtt }} {{ history.soldCurrency }}
                                    </div>

                                    <div class="font-weight-normal" v-if="history.operation === 'sell'">
                                        <strong> @ {{history.date}} - {{ history.exchange }} </strong> :
                                        Sold {{ history.soldCurrencyQtt }} {{ history.soldCurrency }} to {{ history.boughtCurrencyQtt }} {{ history.boughtCurrency }}
                                    </div>
                                </div>
                            </v-timeline-item>
                        </div>
                    </div> 

                    <div v-else> 
                        <div v-for="history in historyList"
                        :key="history.id">
                            <div>
                                <v-timeline-item
                                color="blue"
                                small
                                >
                                    <div class="font-weight-normal" v-if="history.operation === 'buy'">
                                        <strong> @ {{history.date}} - {{ history.exchange }} </strong> :
                                        Bought {{ history.boughtCurrencyQtt }} {{ history.boughtCurrency }} with {{ history.soldCurrencyQtt }} {{ history.soldCurrency }}
                                    </div>

                                    <div class="font-weight-normal" v-if="history.operation === 'sell'">
                                        <strong> @ {{history.date}} - {{ history.exchange }} </strong> :
                                        Sold {{ history.soldCurrencyQtt }} {{ history.soldCurrency }} to {{ history.boughtCurrencyQtt }} {{ history.boughtCurrency }}
                                    </div>
                                </v-timeline-item>
                            </div>
                        </div>
                    </div> 
                </v-timeline>

                <div class="text-right">
                    <button v-if='!showAll' @click="showAll = !showAll"> Show More </button>
                    <button v-if='showAll' @click="showAll = !showAll"> Show less </button>
                </div>
            </v-card-text>
        </v-card>
    </v-app>
</template>


<script>
// @ is an alias to /src
import { mapGetters } from 'vuex'

export default {
  name:"displayHistory",
  
  data() {
      return {
          showAll: false,
      }
  },

  computed: {
    ...mapGetters({
      historyList: 'getHistory'
    }),
  },

  async created() {
    await this.$store.dispatch('get_history')
  }
};
</script>
,