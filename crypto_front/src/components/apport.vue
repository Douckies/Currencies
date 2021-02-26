<template>
  <v-row justify="center">
    <v-col>
      <v-card>
        <v-card-text>
          <v-text-field
            v-model='addApport.plateforme'
            label="Plateforme"
            required
            placeholder="Binance"
          ></v-text-field>
          <v-text-field
            v-model='addApport.apport'
            label="Montant (€)"
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
      <p> {{addApport}} </p>
    </v-col>
  </v-row>
</template>

<script>

export default {

    data() {
      return {
        addApport: {}
      }
    },

    methods: {
      submit() {
        console.log('submit'+this.addApport)
        this.$store.dispatch('post_apport', this.addApport)
      }
    },
}
</script>