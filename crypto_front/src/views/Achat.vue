<template>
  <v-app>
    <v-row>
      <v-spacer/>
      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='apport = true; refill = false; nouveau = false'>
          Apport
        </v-btn>
      </v-col>

      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='nouveau = true; refill = false; apport = false'>
          New
        </v-btn>
      </v-col>

      <v-col md="2">
        <v-btn class="ma-1" plain 
        @click='refill = true; nouveau = false; apport = false'>
          Refill
        </v-btn>
      </v-col>
      <v-spacer/>
    </v-row>

    <v-row>
      <v-spacer/>
      <v-col>
        <div v-if='refill'>
          <refillCoinForm/>
        </div>

        <div v-if='nouveau'>
          <newCoinForm/>
        </div>

        <div v-if='apport'>
          <apport/>
        </div>
      </v-col>
      <v-spacer/>
    </v-row>
  </v-app>
</template>

<script>
import newCoinForm from '@/components/newCoinForm.vue'
import refillCoinForm from '@/components/refillCoinForm.vue'
import apport from '@/components/apport.vue'

  export default {
    components: {
      newCoinForm,
      refillCoinForm,
      apport
    },

    data() {
      return {
        nouveau: false,
        refill: false,
        apport: false
      }
    },

    created() {
      this.$store.dispatch('get_crypto')
    }
  }
</script>