<template>
<v-app>
    <v-row>
        <v-col>
            <h1> Plateforme {{plateforme.plateforme}} </h1>
            <p> Crypto possédée sur cette plateforme : </p>
            <ul>
                <li v-for='crypto in crypto'
                :key='crypto.nom'>
                    {{crypto.nom}}
                </li>
            </ul>
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
            required: true
        }
    }
}
</script>