<template>
    <v-app>
        <v-row>
            <v-col>
                <v-card>
                    <v-list-item three-line>
                    <v-list-item-content>
                        <div class="overline mb-4">
                            {{plateforme.plateforme}} 
                        </div>
                        <v-list-item-subtitle>Investissement sur la plateforme : {{plateforme.apport}}€.</v-list-item-subtitle>
                        <v-list-item-subtitle>{{ crypto.length }} cryptos possédées sur cette plateforme.</v-list-item-subtitle>
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
        plateforme: {
            type: Object,
            required: true
        },
        crypto: {
            type: Array,
            default: () => [{}, {}],
            required: true
        }
    },
}
</script>