import apiCalls from '@/service/apiCalls.js'

export default {
    state: {
        curenciesOwned: [],
        totalInvestment: []
    },
    mutations: {
        GET_CRYPTO(state, value) {
            state.curenciesOwned = value.data
        },

        POST_CRYPTO(state, value) {
            state.curenciesOwned.push(value)
        },

        GET_INVESTMENT(state, value) {
            state.totalInvestment = value.data
        },

        POST_APPORT() {

        },

        SELLING_CURRENCY() {

        }
    },
    actions: {
        async get_currencies_owned({commit}) {
            const value = await apiCalls.getCurrenciesOwned()
            if(value) {
                commit('GET_CRYPTO', value)
            }
        },

        async post_buyCurrency({commit}, newCurrencyToBuy) {
            await apiCalls.postBuyNewCurrency(newCurrencyToBuy)
            commit('POST_CRYPTO', newCurrencyToBuy)
        },

        async post_sellCurrency({commit}, currencyToSell) {
            await apiCalls.postSellCurrency(currencyToSell)
            commit('SELLING_CURRENCY')
        },

        async get_investment({commit}) {
            const value = await apiCalls.getInvestment()
            if(value) {
                commit('GET_INVESTMENT', value)
            }
        },

        async post_investment({commit}, investment) {
            await apiCalls.postInvestInExchange(investment)
            commit('GET_APPORT', investment)
        },
    },
    getters: {
        getCurrenciesOwned: state => state.curenciesOwned,
        getCurrenciesExchangeBinance: state => state.curenciesOwned.filter(currency => currency.plateforme === 'Binance'),
        getCurrenciesExchangeCryptoCom: state => state.curenciesOwned.filter(currency => currency.plateforme === 'Crypto.com'),
        getCurrenciesExchangeSwissborg: state => state.curenciesOwned.filter(currency => currency.plateforme === 'SwissBorg'),
        
        getTotalInvestment: state => state.totalInvestment,
        getExchanges: state => state.totalInvestment.map(item => item.plateforme),


        getCurrenciesNameByExchange: (state) => (exchangeToFilter) => {
            let currenciesFiltered = state.curenciesOwned.filter(currency => currency.plateforme === exchangeToFilter)
            return currenciesFiltered.map(currency => currency.nom)
        }
    },
    modules: {}
}