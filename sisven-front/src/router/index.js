import { createRouter, createWebHashHistory } from "vue-router";

// Vistas principales
import Home from "../views/HomeView.vue";
import Customers from "../views/Customers.vue";
import Categories from "../views/Categories.vue";
import PayMode from "../views/PayMode.vue";
import Products from "../views/Products.vue";

// Componentes de Customers
import NewCustomer from "../components/customers/NewCustomer.vue";
import EditCustomer from "../components/customers/EditCustomer.vue";

// Componentes de Categories
import NewCategories from "../components/categories/NewCategories.vue";
import EditCategories from "../components/categories/EditCategories.vue";

// Componentes de PayModes
import NewPayMode from "../components/paymode/NewPayMode.vue";
import EditPayMode from "../components/paymode/EditPayMode.vue";

// Componentes de Products
import NewProduct from "../components/products/NewProduct.vue";
import EditProduct from "../components/products/EditProduct.vue"; 

const routes = [
  // Home
  {
    path: "/",
    name: "Home",
    component: Home,
  },

  // Customers
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

  // Categories
  {
    path: "/categories",
    name: "Categories",
    component: Categories,
  },
  {
    path: "/categories/new",
    name: "NuevaCategoria",
    component: NewCategories,
  },
  {
    path: "/categories/:id/edit",
    name: "EditarCategoria",
    component: EditCategories,
  },

  // Pay Modes
  {
    path: "/pay-modes",
    name: "PayModes",
    component: PayMode,
  },
  {
    path: "/pay-modes/new",
    name: "NuevoModoPago",
    component: NewPayMode,
  },
  {
    path: "/pay-modes/:id/edit",
    name: "EditarModoPago",
    component: EditPayMode,
  },

  // Products (NUEVO)
  {
    path: "/products",
    name: "Products",
    component: Products,
  },
  {
    path: "/products/new",
    name: "NuevoProducto",
    component: NewProduct,
  },
  {
    path: "/products/:id/edit",
    name: "EditarProducto",
    component: EditProduct,
  },

  // About (Lazy load)
  {
    path: "/about",
    name: "About",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
