import AdminIndex from "./index/AdminIndex";
import SettingsMain from "./setting/SettingsMain";

const router = new VueRouter({
    routes: [
        {path: '/', component: AdminIndex, meta: {title: '仪表板', group: 'home'}},
        {path: '/settings', component: SettingsMain, meta: {title: '系统设置', group: 'settings'}}
    ]
});

const UserRoutes = require('./user/routes');
router.addRoutes(UserRoutes);

const WechatRoutes = require('./wechat/routes');
router.addRoutes(WechatRoutes);

const OtherRoutes = require('./common/routes');
router.addRoutes(OtherRoutes);

const PageRoutes = require('./page/routes');
router.addRoutes(PageRoutes);

const TradeRoutes = require('./trade/routes');
router.addRoutes(TradeRoutes);

const PostRoutes = require('./post/routes');
router.addRoutes(PostRoutes);

const EcomRoutes = require('./ecom/routes');
router.addRoutes(EcomRoutes);

router.addRoutes([
    {
        path: '*',
        component: () => require('./error/404')
    }
]);

module.exports = router;
