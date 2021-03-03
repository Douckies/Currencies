<template>
<v-app>
    <v-row>
        <v-col>
            <h1> Exchange {{selectedExchange.plateforme}} </h1>
            <p> Currencies available in this exchange : </p>
            <ul>
                <li v-for='currency in exchangeCurrencies'
                :key='currency.nom'>
                    {{currency.nom}}
                </li>
            </ul>
        </v-col>
    </v-row>
</v-app>
</template>

<script>
export default {
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