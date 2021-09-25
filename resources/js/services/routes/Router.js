import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);
import routes from './Routes';
const router = new VueRouter({
    mode:'history',
   // linkActiveClass: 'is-active',
    routes
});

export default router;
