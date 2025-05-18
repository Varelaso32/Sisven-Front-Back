import { createRouter, createWebHashHistory } from 'vue-router';
import Home from '../views/HomeView.vue';
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
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
