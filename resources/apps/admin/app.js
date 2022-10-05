import vuedraggable from 'vuedraggable';
import ImagePicker from "../lib/ImagePicker";
import LocationPicker from "../lib/LocationPicker";
// import KindEditor from "../lib/KindEditor";
import VueEditor from "../lib/VueEditor";
import Main from './common/Main';

Vue.component('vuedraggable', vuedraggable);
Vue.component('image-picker', ImagePicker);
Vue.component('location-picker', LocationPicker);
//Vue.component('kind-editor', KindEditor);
Vue.component('vue-editor', VueEditor);

let API_URL = '/admin';
let getApi = (path) => {
    return API_URL + path;
}

let httpGet = (path, params = {}, config = {}) => {
    return new Promise((resolve, reject) => {
        if (params) config.params = params;
        axios.get(API_URL + path, config).then(response => {
            if (response.data.errCode) {
                if (response.data.errCode === 401) {
                    window.location.reload();
                }
                reject(response.data);
            } else {
                resolve(response.data);
            }
        }).catch(reason => {
            if (reason.statusCode === 401){
                window.location.reload();
            }
            reject(reason);
        });
    });
};

let httpPost = (path, data = {}, config = {}) => {
    return new Promise((resolve, reject) => {
        axios.post(API_URL + path, data, config).then(response => {
            if (response.data.errCode) {
                if (response.data.errCode === 401) {
                    window.location.reload();
                }
                reject(response.data);
            } else {
                resolve(response.data);
            }
        }).catch(reason => {
            if (reason.statusCode === 401){
                window.location.reload();
            }
            reject(reason);
        });
    });
};

Vue.prototype.$get = httpGet;
Vue.prototype.$post = httpPost;
Vue.prototype.$getApi = getApi;

window._ = require('lodash');

const router = require('./router');
const store = require('./store');

router.beforeEach((to, from, next) => {
    //console.log(store.state.auth);
    let {title} = to.meta;
    if (title) {
        document.title = title + '-后台管理中心';
    }
    next();
});

new Vue({
    router,
    store,
    render(h) {
        return h(Main);
    }
}).$mount('#app');
