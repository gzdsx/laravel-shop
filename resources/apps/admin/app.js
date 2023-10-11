import vuedraggable from 'vuedraggable';
import LocationPicker from "../lib/LocationPicker";
// import KindEditor from "../lib/KindEditor";
import VueEditor from "../lib/VueEditor";
import Main from './layout/Main';
import MainLayout from "./layout/MainLayout";
import FixedBottom from "./layout/FixedBottom";
import MediaDialog from "./components/MediaDialog";
import VueClipboard from 'vue-clipboard2';
import ApiService from "./utils/ApiService";

Vue.use(VueClipboard);

Vue.component('vuedraggable', vuedraggable);
Vue.component('location-picker', LocationPicker);
//Vue.component('kind-editor', KindEditor);
Vue.component('vue-editor', VueEditor);
Vue.component('media-dialog', MediaDialog);
Vue.component('main-layout', MainLayout);
Vue.component('fixed-bottom', FixedBottom);

Vue.prototype.$get = (url, params, config = {}) => {
    config.params = {
        ...config.params,
        ...params
    }
    return ApiService.get(url, config);
};
Vue.prototype.$post = (url, data, config = {}) => {
    return ApiService.post(url, data, config);
};

Vue.prototype.$request = (config = {}) => {
    return ApiService.request(config);
}

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
