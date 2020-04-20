import App from './common/App';

const router = require('./router');

new Vue({
    router,
    render: function (h) {
        return h(App);
    }
}).$mount('#app');
