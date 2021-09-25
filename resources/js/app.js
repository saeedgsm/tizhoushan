import './bootstrap';

import Vuelidate from "vuelidate/src";
Vue.use(VueResouce);
Vue.use(Vuelidate);
import router from "./services/routes/Router";
import {store} from "./services/store/Store";

import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer);
    toast.addEventListener('mouseleave', Swal.resumeTimer);
  }
});
window.Toast = Toast;

import Pagination from 'vue-pagination-2';
Vue.http.options.root = window.location.protocol + "//" + window.location.host + "/";
let site_url = window.location.protocol + "//" + window.location.host + "/";
Vue.use(Pagination,site_url);

//Import v-from
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el:'#app',
    store,
    router,
});

export default app;

