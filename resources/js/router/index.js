import { createRouter, createWebHistory } from "vue-router";

import Soal1 from "../components/Soal1.vue";
import Soal2 from "../components/Soal2.vue";

const routes = [
    { path: "/", component: Soal1 },
    { path: "/crud", component: Soal2 },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
