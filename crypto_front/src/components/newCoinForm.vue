<template>
  <v-row>
    <v-col>
      <v-card>
        <v-card-text>
          <v-select
            :items="plateforme"
            label="Plateforme"
          ></v-select>

          <v-text-field
            ref="nom"
            v-model="newCoin.nom"
            label="Nom de la crypto"
            placeholder="BTC"
            required clearable
          ></v-text-field>

          <v-text-field
            ref="qtt"
            v-model="newCoin.qtt"
            label="Quantité acheté"
            placeholder="10"
            required clearable
          ></v-text-field>

          <v-text-field
            ref="investissement"
            v-model="newCoin.investissement"
            label="Investissement"
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
    </v-col>
  </v-row>
</template>

<script>
//import apiCalls from '@/service/apiCalls.js'
import { mapGetters } from 'vuex'

  export default {
    data: () => ({
      newCoin: {}
    }),

    methods: {
      async submit () {
        //console.log('newcoin : '+this.newCoin)
        this.$store.dispatch('post_newCrypto', this.newCoin)
        //await apiCalls.postAchatCrypto(this.newCoin)
      },
    },

    computed: {
      ...mapGetters({
        plateforme: 'getPlateforme'
      }) 
    },
  }
</script>