<template>
    <v-app>
        <v-row>
            <v-col>
                <v-card>
                    <v-list-item three-line>
                    <v-list-item-content>
                        <div class="overline mb-4">
                            {{exchangeCardProp.plateforme}} 
                        </div>
                        <v-list-item-subtitle>Total investment in this exchange : {{exchangeCardProp.apport}}€.</v-list-item-subtitle>
                        <v-list-item-subtitle>{{ currenciesCardProp.length }} currencies owned on this exchange.</v-list-item-subtitle>
                    </v-list-item-content>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>
    </v-app>
</template>

<script>

export default {
    props: {
        exchangeCardProp: {
            type: Object,
            required: true
        },
        currenciesCardProp: {
            type: Array,
            default: () => [{}, {}],
            required: true
        }
    },
}
</script>