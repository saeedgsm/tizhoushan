import Vue from 'vue';
import VueResource from 'vue-resource';
import Axios from 'axios';

window.Vue = Vue;
window.VueResouce = VueResource;
window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

