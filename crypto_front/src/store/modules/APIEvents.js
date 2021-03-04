import apiCalls from '@/service/apiCalls.js'

export default {
    state: {
        curenciesOwned: [],
        totalInvestment: [],
        history: [],
        todayDate: new Date().toLocaleString(),
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

        GET_HISTORY(state, value) {
            state.history = value.data
        },

        POST_HISTORY() {

        }
    },
    actions: {
        async get_currencies_owned({commit}) {
            const value = await apiCalls.getCurrenciesOwned()
            if(value) {
                commit('GET_CRYPTO', value)
            }
        },

        async post_orderCurrency({commit}, newOrder) {
            await apiCalls.postOrderCurrency(newOrder)
            commit('POST_CRYPTO', newOrder)
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

        async get_history({commit}) {
            const value = await apiCalls.getHistory()
            if(value) {
                commit('GET_HISTORY', value)
            }
        },

        async post_history({state, commit}, order) {
            order.date = state.todayDate            
            await apiCalls.postHistory(order)
            commit('POST_HISTORY')
        },
    },
    getters: {
        getCurrenciesOwned: state => state.curenciesOwned,
        getCurrenciesExchangeBinance: state => state.curenciesOwned.filter(currency => currency.plateforme === 'Binance'),
        getCurrenciesExchangeCryptoCom: state => state.curenciesOwned.filter(currency => currency.plateforme === 'Crypto.com'),
        getCurrenciesExchangeSwissborg: state => state.curenciesOwned.filter(currency => currency.plateforme === 'SwissBorg'),
        
        getTotalInvestment: state => state.totalInvestment,
        getExchanges: state => state.totalInvestment.map(item => item.plateforme),

        getHistory: state => state.history,

        getCurrenciesNameByExchange: (state) => (exchangeToFilter) => {
            let currenciesFiltered = state.curenciesOwned.filter(currency => currency.plateforme === exchangeToFilter)
            return currenciesFiltered.map(currency => currency.nom)
        }
    },
    modules: {}
}