import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import List from "../views/List.vue";
import Operations from "../views/Operations.vue";
import Exchange from "../views/Exchange.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/list",
    name: "List",
    component: List
  },
  {
    path: "/operations",
    name: "Operations",
    component: Operations
  },
  {
    path: '/exchange',
    props: true,
    name: 'Exchange',
    component: Exchange
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
