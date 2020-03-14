import routes from './routes';

const router = new VueRouter({
    routes
});

const app = new Vue({
    router
}).$mount('#app');
