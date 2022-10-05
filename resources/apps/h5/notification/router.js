import NotificationIndex from "./NotificationIndex";
import NotificationDetail from "./NotificationDetail";

module.exports = [
    {path: '/notification/index', component: NotificationIndex, meta: {title: '消息', auth: true}},
    {path: '/notification/detail/:id?', component: NotificationDetail, meta: {title: '消息', auth: true}},
]
