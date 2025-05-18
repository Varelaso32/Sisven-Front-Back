import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faUser,
  faIdCard,
  faMapMarkerAlt,
  faCalendar,
  faPhone,
  faEnvelope,
  faEdit,
  faTrash,
  faPlus,
  faCheck,
  faTimes,
  faHome,
  faPencil
} from '@fortawesome/free-solid-svg-icons';

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

library.add(
  faUser,
  faIdCard,
  faMapMarkerAlt,
  faCalendar,
  faPhone,
  faEnvelope,
  faEdit,
  faTrash,
  faPlus,
  faCheck,
  faTimes,
  faHome,
  faPencil
);

createApp(App)
  .component("font-awesome-icon", FontAwesomeIcon)
  .use(router)
  .mount("#app");
