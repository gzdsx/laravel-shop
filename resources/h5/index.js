require('./common');
const VueRouter = require('vue-router');
Vue.use(VueRouter);

const routes = require('./routes');
const router = new VueRouter({
    routes
});

const app = new Vue({
    router
}).$mount('#app');
