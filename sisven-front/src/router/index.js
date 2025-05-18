import { createRouter, createWebHashHistory } from "vue-router";
import Home from "../views/HomeView.vue";
import Customers from "../views/Customers.vue";
import NewCustomer from "../components/customers/NewCustomer.vue";
import EditCustomer from "../components/customers/EditCustomer.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/customers",
    name: "Customers",
    component: Customers,
  },
  {
    path: "/customers/new",
    name: "NuevoCliente",
    component: NewCustomer,
  },
  {
    path: "/customers/:id/edit",
    name: "EditarCliente",
    component: EditCustomer,
  },
  {
    path: "/about",
    name: "About",
    // carga perezosa
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
