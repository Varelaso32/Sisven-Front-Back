import { createRouter, createWebHashHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Customers from '../views/Customers.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/customers',
    name: 'Customers',
    component: Customers
  },
  {
    path: '/about',
    name: 'About',
    // carga perezosa
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
