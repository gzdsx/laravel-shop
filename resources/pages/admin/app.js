import vuedraggable from 'vuedraggable';
import App from './common/App';

const router = require('./router');

Vue.component('vuedraggable', vuedraggable);
new Vue({
    router,
    render: function (h) {
        return h(App);
    }
}).$mount('#app');
