import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Propriedade from './pages/Propriedade.vue';
import Contrato from './pages/Contrato.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/propriedades',
            name: 'propriedades',
            component: Propriedade
        },
        {
            path: '/contratos',
            name: 'contratos',
            component: Contrato
        }
    ]
});

export default router;
