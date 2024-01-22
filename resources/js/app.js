import "./bootstrap";

import { createApp } from "vue";

import app from "./components/App.vue";
// import BootstrapVue3 from "bootstrap-vue-3";
// import "bootstrap/dist/css/bootstrap.css";
// import "bootstrap-vue-3/dist/bootstrap-vue-3.css";

import router from "./router/index.js";

createApp(app).use(router).mount("#app");
