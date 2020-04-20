import App from './components/App';
import UserIndex from './user/UserIndex';
import Security from "./user/Security";
import FeedBack from "./user/FeedBack";
import Aboutus from "./user/Aboutus";
import Address from "./user/Address";
import OrderList from "./user/OrderList";
import OrderDetail from "./user/OrderDetail";

const router = new VueRouter({
    routes: [
        {path: '/', component: UserIndex, meta: {title: '个人中心'}},
        {path: '/security', component: Security, meta: {title: '账户安全'}},
        {path: '/feedback', component: FeedBack, meta: {title: '意见反馈'}},
        {path: '/aboutus', component: Aboutus, meta: {title: '关于我们'}},
        {path: '/address', component: Address, meta: {title: '收货地址管理'}},
        {path: '/order/list', component: OrderList, meta: {title: '订单列表'}},
        {path: '/order/list/:tab', component: OrderList, meta: {title: '订单列表'}},
        {path: '/order/detail/:order_id', component: OrderDetail, meta: {title: '订单详情'}},
    ]
});

// 根据路由设置标题
router.beforeEach((to, from, next) => {
    /*路由发生改变修改页面的title */
    if (to.meta.title) {
        document.title = to.meta.title
    }
    next();
});

new Vue({
    router,
    render: function (h) {
        return h(App);
    }
}).$mount('#app');
