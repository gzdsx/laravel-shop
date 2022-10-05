import OrderList from "./OrderList";
import OrderDetail from "./OrderDetail";
import RefundList from "./RefundList";
import RefundDetail from "./RefundDetail";
import Transaction from "./Transaction";

module.exports = [
    {path: '/order/list', component: OrderList, meta: {title: '订单管理', group: 'trade'}},
    {path: '/order/detail/:order_id?', component: OrderDetail, meta: {title: '订单详情', group: 'trade'}},
    {path: '/refund/list', component: RefundList, meta: {title: '退款管理', group: 'trade'}},
    {path: '/refund/detail/:refund_id?', component: RefundDetail, meta: {title: '退款详情', group: 'trade'}},
    {path: '/transaction/list', component: Transaction, meta: {title: '交易流水', group: 'trade'}},
]
