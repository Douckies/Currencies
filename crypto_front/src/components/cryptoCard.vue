<template>
    <v-card>
        <v-list-item three-line>
            <v-list-item-content>
                <div class="overline mb-4">
                    {{exchangeCardProp.plateforme}}
                </div>
                <v-list-item-subtitle>Total investment : {{exchangeCardProp.apport}}$.</v-list-item-subtitle>
                <v-list-item-subtitle>{{ currenciesCardProp.length }} currencies owned.</v-list-item-subtitle>
                <v-list-item-subtitle v-if="USDOwnedOnExchange[0] < 1">Less than 1 USD / USDT. </v-list-item-subtitle>
                <v-list-item-subtitle v-else> {{USDOwnedOnExchange[0]}} USD / USDT. </v-list-item-subtitle>
                <v-list-item-subtitle> Previsionnal benefits : {{totalBenefits.toFixed(2)}}$ </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
    </v-card>
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

    computed: {
        USDOwnedOnExchange() {
            return this.$store.getters.getUSDByExchange(this.exchangeCardProp.plateforme)
        },

        totalBenefits: function () {
            let  totalBenefit = 0

            for (let i = 0; i < this.currenciesCardProp.length; i++) {
                totalBenefit += Number(this.currenciesCardProp[i].actualBenefits)
            }

            return totalBenefit
        }
    }
}
</script>