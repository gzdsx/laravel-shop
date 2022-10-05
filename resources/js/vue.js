import Vue from 'vue';
import Vuex from 'vuex';
import showToast from '../apps/lib/toast';
import VueClipBoard from 'vue-clipboard2'
import Validate from "gzdsx-validate";
import {API_URL} from './config';
import axios from 'axios';

Vue.use(Vuex);
Vue.use(VueClipBoard);
Vue.use(showToast);

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
    //console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    let accessToken = localStorage.getItem('accessToken');
    if (accessToken) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + accessToken;
        Vue.prototype.$accessToken = accessToken;
    }
}

let getApi = (path) => {
    return API_URL + path;
}

let httpGet = (path, params = {}, config = {}) => {
    return new Promise((resolve, reject) => {
        if (params) config.params = params;
        axios.get(API_URL + path, config).then(response => {
            if (response.data.errCode) {
                reject(response.data);
            } else {
                resolve(response.data);
            }
        }).catch(reason => {
            reject(reason);
        });
    });
};

let httpPost = (path, data = {}, config = {}) => {
    return new Promise((resolve, reject) => {
        axios.post(API_URL + path, data, config).then(response => {
            if (response.data.errCode) {
                reject(response.data);
            } else {
                resolve(response.data);
            }
        }).catch(reason => {
            reject(reason);
        });
    });
};

Vue.prototype.$axios = axios;
Vue.prototype.$validator = Validate;
Vue.prototype.$get = httpGet;
Vue.prototype.$post = httpPost;
Vue.prototype.$getApi = getApi;

window.Vue = Vue;
window.axios = axios;
window.httpGet = httpGet;
window.httpPost = httpPost;
