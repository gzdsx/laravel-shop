import Main from "./components/Main";
import Index from "./index/Index";
import UserInfo from "./user/UserInfo";
import Security from "./user/Security";
import AddressList from "./address/AddressList";
import TransactionList from "./transaction/TransactionList";
import PostCollect from "./collect/PostCollect";
import ItemCollect from "./collect/ItemCollect";
import BoughtList from "./bought/BoughtList";
import BoughtDetail from "./bought/BoughtDetail";

const router = new VueRouter({
    routes: [
        {path: '/', component: Index, meta: {title: '用户中心'}},
        {path: '/userinfo', component: UserInfo, meta: {title: '资料设置'}},
        {path: '/security', component: Security, meta: {title: '账号安全'}},
        {path: '/address', component: AddressList, meta: {title: '收货地址'}},
        {path: '/transaction', component: TransactionList, meta: {title: '我的订单'}},
        {path: '/collect', component: PostCollect, meta: {title: '我的收藏'}},
        {path: '/collect/post', component: PostCollect, meta: {title: '我的收藏'}},
        {path: '/collect/item', component: ItemCollect, meta: {title: '我的收藏'}},
        {path: '/bought', component: BoughtList, meta: {title: '我的订单'}},
        {path: '/bought/detail/:order_id', component: BoughtDetail, meta: {title: '订单详情'}},
    ]
});

new Vue({
    router,
    render(h) {
        return h(Main)
    }
}).$mount('#app');
