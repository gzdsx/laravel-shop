import ReactRouter from "./ReactRouter";
import TabBar from "./TabBar";

let router = new ReactRouter([
    {name: 'TabBar', component: TabBar, options: {headerShown: false}},
]);

let CommonRoutes = require('../pages/common/routes');
router.addRoutes(CommonRoutes);

let HomeRoutes = require('../pages/home/routes');
router.addRoutes(HomeRoutes);

//
// let NotificationRotes = require('../pages/notification/routes');
// router.addRoutes(NotificationRotes);
//
let OAuthRoutes = require('../pages/oauth/routes');
router.addRoutes(OAuthRoutes);

let PostRoutes = require('../pages/post/routes');
router.addRoutes(PostRoutes);

let PageRoutes = require('../pages/page/routes');
router.addRoutes(PageRoutes);

let EcomRoutes = require('../pages/ecom/routes');
router.addRoutes(EcomRoutes);

let TradeRoutes = require('../pages/trade/routes');
router.addRoutes(TradeRoutes);

let RefundRoutes = require('../pages/refund/routes');
router.addRoutes(RefundRoutes);

export default router;
