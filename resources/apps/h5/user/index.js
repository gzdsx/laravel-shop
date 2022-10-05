import UserApp from "./UserApp";
import App from "../common/App";
import SecurityApp from "./security/SecurityApp";
import PasswordApp from "./security/PasswordApp";
import PaymentPwdApp from "./security/PaymentPwdApp";
import MobileApp from "./security/MobileApp";
import EmailApp from "./security/EmailApp";
import FeedBack from "./FeedBack";
import AddressView from "./address/AddressView";
import OrderList from "../order/OrderList";
import OrderDetail from "../order/OrderDetail";
import RefundList from "../refund/RefundList";
import RefundRouter from "../refund/RefundRouter";
import RefundDetail from "../refund/RefundDetail";
import RefundSend from "../refund/RefundSend";
import RefundApply from "../refund/RefundApply";
import FavoriteApp from "./favorite/FavoriteApp";
import SettingIndex from "./setting/SettingIndex";
import ProfileIndex from "./profile/ProfileIndex";

const router = new VueRouter({
    routes: [
        {path: '/', component: UserApp, meta: {title: '个人中心'}},
        {path: '/security', component: SecurityApp, meta: {title: '账号安全'}},
        {path: '/security/password', component: PasswordApp, meta: {title: '设置登录密码'}},
        {path: '/security/paymentpwd', component: PaymentPwdApp, meta: {title: '设置支付密码'}},
        {path: '/security/mobile', component: MobileApp, meta: {title: '绑定手机'}},
        {path: '/security/email', component: EmailApp, meta: {title: '绑定邮箱'}},
        {path: '/feedback', component: FeedBack, meta: {title: '帮助与反馈'}},
        {path: '/address', component: AddressView, meta: {title: '收货地址'}},
        {path: '/order/list', component: OrderList, meta: {title: '我的订单'}},
        {path: '/order/detail', component: OrderDetail, meta: {title: '订单详情'}},
        {path: '/refund/list', component: RefundList, meta: {title: '退款/售后'}},
        {path: '/refund/router', component: RefundRouter, meta: {title: '选择服务'}},
        {path: '/refund/apply', component: RefundApply, meta: {title: '选择服务'}},
        {path: '/refund/detail', component: RefundDetail, meta: {title: '退款详情'}},
        {path: '/refund/send', component: RefundSend, meta: {title: '发货'}},
        {path: '/favorite', component: FavoriteApp, meta: {title: '我的收藏'}},
        {path: '/setting', component: SettingIndex, meta: {title: '设置'}},
        {path: '/profile', component: ProfileIndex, meta: {title: '个人资料', auth: true}},
    ]
});

const store = require('../../vuex/store');

router.beforeEach(((to, from, next) => {
    console.log(to);
    if (to.meta.title) {
        document.title = to.meta.title;
    }
    next();
}))

new Vue({
    router,
    store,
    render(h) {
        return h(App);
    }
}).$mount('#app');
