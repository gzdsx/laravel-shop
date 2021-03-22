import Vue from 'vue';
import axios from 'axios';
import Validate from "gzdsx-validate";
import Toast from '../apps/lib/toast';
import {API_URL} from './config';

Vue.use(Toast);

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    Vue.prototype.$csrfToken = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.prototype.$axios = axios;
Vue.prototype.$validator = Validate;
Vue.prototype.$get = (path, params = {}, config = {}) => {
    if (params) config.params = params;
    return new Promise((resolve, reject) => {
        axios.get(API_URL + path, config).then(response => {
            if (response.data.errcode) {
                reject(response);
            } else {
                resolve(response);
            }
        }).catch(reason => {
            reject(reason);
        });
    });
};

Vue.prototype.$post = (path, data = {}) => {
    return new Promise((resolve, reject) => {
        axios.post(API_URL + path, data).then(response => {
            if (response.data.errcode) {
                reject(response);
            } else {
                resolve(response);
            }
        }).catch(reason => {
            reject(reason);
        });
    });
};

window.Vue = Vue;
window.axios = axios;
