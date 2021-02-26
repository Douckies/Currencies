import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Liste from "../views/Liste.vue";
import Achat from "../views/Achat.vue";
import Vente from "../views/Vente.vue";
import Plateforme from "../views/Plateforme.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/liste",
    name: "Liste",
    component: Liste
  },
  {
    path: "/vente",
    name: "Vente",
    component: Vente
  },
  {
    path: "/achat",
    name: "Achat",
    component: Achat
  },
  {
    path: '/plateforme',
    props: true,
    name: 'plateforme',
    component: Plateforme
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
