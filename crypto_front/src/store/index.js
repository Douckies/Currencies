import Vue from "vue";
import Vuex from "vuex";
import APIEvents from '@/store/modules/APIEvents.js'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    APIEvents,
  }
});
