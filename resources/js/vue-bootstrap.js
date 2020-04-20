import Vue from 'vue';
import Axios from 'axios';
import VueRouter from 'vue-router';
import Toast from '../pages/lib/toast';

Vue.use(Toast);
Vue.use(VueRouter);

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.prototype.$axios = Axios;
window._ = require('lodash');
window.Vue = Vue;
window.VueRouter = VueRouter;
