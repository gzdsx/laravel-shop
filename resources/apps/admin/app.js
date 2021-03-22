import Vuex from 'vuex';
import vuedraggable from 'vuedraggable';
import App from './common/App';
import ImagePicker from "../lib/ImagePicker";
// import KindEditor from "../lib/KindEditor";
import VueEditor from "../lib/VueEditor";

Vue.use(Vuex);

var API_URL = '/admin';
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

Vue.component('vuedraggable', vuedraggable);
Vue.component('image-picker', ImagePicker);
//Vue.component('kind-editor', KindEditor);
Vue.component('vue-editor', VueEditor);

window._ = require('lodash');

const router = require('./router');
const store = require('./store');

router.beforeEach((to, from, next) => {
    //console.log(store.state.auth);
    next();
});

new Vue({
    router,
    store,
    render(h) {
        return h(App);
    }
}).$mount('#app');
