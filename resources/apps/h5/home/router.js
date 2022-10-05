import HomeIndex from "./HomeIndex";
import UserBill from "./UserBill";
import UserSetting from "./UserSetting";
import UserProfile from "./UserProfile";
import UpdateUserName from "./UpdateUserName";
import BindSuperior from "./BindSuperior";
import Security from "./Security";
import ResetPassword from "./ResetPassword";
import ResetPaymentPassword from "./ResetPaymentPassword";
import BindMobile from "./BindMobile";
import BindEmail from "./BindEmail";
import Favorite from "./Favorite";
import FeedBack from "./FeedBack";
import KefuList from "./KefuList";
import AddressList from "./AddressList";

import Wallet from "./Wallet";
import TransferFill from "./TransferFill";
import Transfer from "./Transfer";

module.exports = [
    {path: '/home/index', component: HomeIndex, meta: {title: '个人中心', auth: false}},
    {path: '/home/user-setting', component: UserSetting, meta: {title: '个人设置', auth: true}},
    {path: '/home/user-bill', component: UserBill, meta: {title: '我的账单', auth: true}},
    {path: '/home/user-profile', component: UserProfile, meta: {title: '个人资料', auth: true}},
    {path: '/home/update-username', component: UpdateUserName, meta: {title: '修改姓名', auth: true}},
    {path: '/home/security', component: Security, meta: {title: '账号安全', auth: true}},
    {path: '/home/reset-password', component: ResetPassword, meta: {title: '设置登录密码', auth: true}},
    {path: '/home/reset-payment-password', component: ResetPaymentPassword, meta: {title: '设置支付密码', auth: true}},
    {path: '/home/bind-mobile', component: BindMobile, meta: {title: '绑定手机', auth: true}},
    {path: '/home/bind-email', component: BindEmail, meta: {title: '绑定邮箱', auth: true}},
    {path: '/home/bind-superior', component: BindSuperior, meta: {title: '绑定联系人', auth: true}},
    {path: '/home/wallet', component: Wallet, meta: {title: '我的钱包', auth: true}},
    {path: '/home/transfer', component: Transfer, meta: {title: '转账', auth: true}},
    {path: '/home/transfer-fill', component: TransferFill, meta: {title: '转账', auth: true}},
    {path: '/home/favorite', component: Favorite, meta: {title: '我的收藏', auth: true}},
    {path: '/home/kefu', component: KefuList, meta: {title: '联系客服', auth: true}},
    {path: '/home/address', component: AddressList, meta: {title: '我的地址', auth: true}},
    {path: '/home/feedback', component: FeedBack, meta: {title: '帮助与反馈', auth: true}},
]
