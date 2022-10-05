import IndexApp from "./index/IndexApp";
//auth
import Login from "./auth/Login";
import VerCodeLogin from "./auth/VerCodeLogin";
import Register from "./auth/Register";
import WxLogin from "./auth/WxLogin";


const router = new VueRouter({
    routes: [
        {path: '/', component: IndexApp, meta: {}},
        {path: '/login', component: Login, meta: {title: '密码登录'}},
        {path: '/wxlogin', component: WxLogin, meta: {title: '微信登录'}, name: 'wxlogin'},
        {path: '/ver_code_login', component: VerCodeLogin, meta: {title: '验证码登录'}},
        {path: '/register', component: Register, meta: {title: '注册'}},
    ]
});


const HomeRouter = require('./home/router');
router.addRoutes(HomeRouter);

const TradeRouter = require('./trade/router');
router.addRoutes(TradeRouter);

const EcomRouter = require('./ecom/router');
router.addRoutes(EcomRouter);

const NotificationRouter = require('./notification/router');
router.addRoutes(NotificationRouter);

const MemberRouter = require('./member/router');
router.addRoutes(MemberRouter);

const JiFenRouter = require('./jifen/router');
router.addRoutes(JiFenRouter);

const PageRouter = require('./page/router');
router.addRoutes(PageRouter);

const FenXiaoRouter = require('./fenxiao/router');
router.addRoutes(FenXiaoRouter);

router.beforeEach(((to, from, next) => {
    let {title} = to.meta;
    if (title) {
        document.title = title;
    } else {
        document.title = window.siteName;
    }
    if (to.meta.auth) {
        if (to.name === 'wxlogin') {
            next();
        } else {
            let accessToken = localStorage.getItem('accessToken');
            if (accessToken) {
                next();
            } else {
                localStorage.setItem('redirect', window.location.href);
                next('/wxlogin');
                //return false;
            }
        }
    }
    next();
}));

module.exports = router;
