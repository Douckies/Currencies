<template>
<v-app>
    <v-row>
        <v-col>
            <h1> Exchange {{selectedExchange.plateforme}} </h1>
            <p> Currencies available in this exchange : </p>
            
            <list :currencies='exchangeCurrencies'/>
        </v-col>
    </v-row>
</v-app>
</template>

<script>
import list from '@/components/listing.vue'

export default {
    components: {
        list
    },

    props: {
        selectedExchange: {
            type: Object,
            required: true
        },
        exchangeCurrencies: {
            type: Array,
            required: true
        }
    }
}
</script>