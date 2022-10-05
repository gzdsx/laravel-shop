import App from "./common/App";
import LoadingView from "./common/LoadingView";
import FloatButton from "./common/FloatButton";
import FixedBottom from "./common/FixedBottom";

Vue.component('loading-view', LoadingView);
Vue.component('float-button', FloatButton);
Vue.component('fixed-bottom', FixedBottom);
Vue.prototype.setBackgroundColor = function (color) {
    document.querySelector("html").setAttribute("style", "background-color:" + color);
}

const router = require('./router');
const store = require('./vuex/store');

new Vue({
    router,
    store,
    render(h) {
        return h(App);
    }
}).$mount('#app');
