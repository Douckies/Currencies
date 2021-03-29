<template>
    <div>
        <v-card-title>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="currencies"
          :search="search"
        >
            <template v-slot:[`item.icone`]="{ item }">
                <div class="p-2">
                    <v-img :src="item.icone" height="30px" width="30px"></v-img>
                </div>
            </template>
        </v-data-table>
    </div>
</template> 

<script>
export default {
    props: {
        currencies: {
            type: Object,
            required: true
        },
    },

    data() {
        return {
            search: '',
            headers: [
                {
                text: 'Exchange',
                align: 'start',
                value: 'plateforme',
                },
                { text: 'Icone', value: 'icone', sortable: false },
                { text: 'Currency', value: 'nom' },
                { text: 'Owned quantity', value: 'qtt' },
                { text: 'Investment', value: 'investissement' },
                { text: 'Actual price', value: 'currentPrice' },
                { text: 'Actual Value', value: 'actualValue' },
                { text: 'Actual benefits', value: 'actualBenefits' },
            ],
        }
    }

}
</script>
