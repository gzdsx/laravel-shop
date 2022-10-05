import RefundList from "./RefundList";
import RefundRouter from "./RefundRouter";
import RefundApply from "./RefundApply";
import RefundDetail from "./RefundDetail";
import RefundSend from "./RefundSend";
import BoughtList from "./BoughtList";
import BoughtDetail from "./BoughtDetail";
import BuyNow from "./BuyNow";

module.exports = [
    //退款
    {path: '/refund/list', component: RefundList, meta: {title: '退款/售后', auth: true}},
    {path: '/refund/router', component: RefundRouter, meta: {title: '选择服务', auth: true}},
    {path: '/refund/apply', component: RefundApply, meta: {title: '选择服务', auth: true}},
    {path: '/refund/detail', component: RefundDetail, meta: {title: '退款详情', auth: true}},
    {path: '/refund/send', component: RefundSend, meta: {title: '发货', auth: true}},
    {path: '/bought/list', component: BoughtList, meta: {title: '我的订单', auth: true}},
    {path: '/bought/detail/:order_id?', component: BoughtDetail, meta: {title: '订单详情', auth: true}},
    {path: '/order/buynow', component: BuyNow, meta: {title: '确认订单', auth: true}},
]
