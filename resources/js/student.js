import './bootstrap';
import Vue from "vue";
import {store} from "./services/store/Store";
import router from "./services/routes/student/Router";

const app = new Vue({
    el:'#app',
    store,
    router,
});

export default app;