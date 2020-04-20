import App from './components/App';
import Index from "./index/Index";

const router = new VueRouter({
    routes:[
        {path:'/',component:Index},
    ]
});

new Vue({
    router,
    render:function (h) {
        return h(App);
    }
}).$mount('#app');
