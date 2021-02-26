import apiCalls from '@/service/apiCalls.js'

export default {
    state: {
        crypto: [],
        apport: []
    },
    mutations: {
        GET_CRYPTO(state, value) {
            state.crypto = value.data
        },

        POST_CRYPTO(state, value) {
            state.crypto.push(value)
        },

        GET_APPORT(state, value) {
            state.apport = value.data
            //console.log(state.apport)
        },

        POST_APPORT() {

        },
    },
    actions: {
        async get_crypto({commit}) {
            const value = await apiCalls.getCrypto()
            if(value) {
                commit('GET_CRYPTO', value)
            }
        },

        async post_newCrypto({commit}, newCrypto) {
            await apiCalls.postAchatCrypto(newCrypto)
            commit('POST_CRYPTO', newCrypto)
        },

        async get_apport({commit}) {
            const value = await apiCalls.getApport()
            if(value) {
                commit('GET_APPORT', value)
            }
        },

        async post_apport({commit}, apport) {
            await apiCalls.postApport(apport)
            commit('GET_APPORT', apport)
        },
    },
    getters: {
        getCryptos: state => state.crypto,
        getCryptoBinance: state => state.crypto.filter(crypto => crypto.plateforme === 'Binance'),
        getCryptoCryptoCom: state => state.crypto.filter(crypto => crypto.plateforme === 'Crypto.com'),
        getCryptoSwissborg: state => state.crypto.filter(crypto => crypto.plateforme === 'Swissborg'),
        
        getApport: state => state.apport,
        getPlateforme: state => state.apport.map(item => item.plateforme),

    },
    modules: {}
}