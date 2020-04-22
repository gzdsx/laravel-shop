import App from './components/App';
import OrderDetail from "./sold/OrderDetail";

// const router = new VueRouter({
//     routes: [
//         {path: '/order/detail/:order_id', component: OrderDetail}
//     ]
// });

// new Vue({
//     router,
//     render: function (h) {
//         return h(App);
//     }
// }).$mount('#app');

new Vue({
    el:'#app',
    render(h){
       return h(OrderDetail)
    }
});
