import AdminIndex from "./index/AdminIndex";
import SettingMain from "./settings/SettingMain";
import UserList from "./user/UserList";
import ProductList from "./product/ProductList";
import ProductEdit from "./product/ProductEdit";
import ProductCategory from "./product/ProductCategory";
import PostList from "./post/PostList";
import PostEdit from "./post/PostEdit";
import PostCategory from "./post/PostCategory";
import PageList from "./page/PageList";
import PageEdit from "./page/PageEdit";
import PageCategory from "./page/PageCategory";
import MaterialList from "./other/MaterialList";
import LinkList from "./other/LinkList";
import DistrictList from "./other/DistrictList";
import OrderList from "./order/OrderList";
import OrderDetail from "./order/OrderDetail";
import TransactionList from "./transaction/TransactionList";
import WechatMenu from "./wechat/WechatMenu";
import WechatMaterial from "./wechat/WechatMaterial";
import ExpressList from "./other/ExpressList";
import BlockList from "./block/BlockList";
import BlockItem from "./block/BlockItem";
import AdList from "./other/AdList";
import FreightList from "./freight/FreightList";
import FreightEdit from "./freight/FreightEdit";
import UserEdit from "./user/UserEdit";
import UserGroupList from "./user/UserGroupList";
import RefundReason from "./other/RefundReason";
import RefundList from "./order/RefundList";
import RefundDetail from "./order/RefundDetail";
import LiveList from "./live/LiveList";
import LiveEdit from "./live/LiveEdit";
import LiveChannel from "./live/LiveChannel";
import LiveAdmins from "./live/LiveAdmins";
import LiveInvite from "./live/LiveInvite";
import LabelList from "./other/LabelList";
import VideoList from "./other/VideoList";
import MenuList from "./menu/MenuList";
import MenuItem from "./menu/MenuItem";
import RefundAddress from "./shop/RefundAddress";


const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: AdminIndex,
            meta: {title: '后台管理中心'},
            name: 'home'
        },
        {path: '/settings', component: SettingMain, meta: {title: '店铺设置'}},
        {path: '/label/list', component: LabelList, meta: {title: '自定义标签'}},
        {path: '/freight/list', component: FreightList, meta: {title: '运费设置'}},
        {path: '/freight/edit', component: FreightEdit, meta: {title: '编辑模板'}},
        {path: '/user/list', component: UserList},
        {path: '/user/edit', component: UserEdit},
        {path: '/user/group', component: UserGroupList},
        {path: '/product/list', component: ProductList,},
        {path: '/product/edit', component: ProductEdit,},
        {path: '/product/category', component: ProductCategory},
        //post
        {path: '/post/list', component: PostList},
        {path: '/post/edit', component: PostEdit},
        {path: '/post/category', component: PostCategory},
        //pages
        {path: '/page/list', component: PageList},
        {path: '/page/edit', component: PageEdit},
        {path: '/page/category', component: PageCategory},
        {path: '/material/list', component: MaterialList},
        {path: '/link/list', component: LinkList},
        {path: '/district/list', component: DistrictList},
        {path: '/order/list', component: OrderList},
        {path: '/order/detail', component: OrderDetail},
        {path: '/transaction/list', component: TransactionList},
        {path: '/wechat/menu', component: WechatMenu},
        {path: '/wechat/material', component: WechatMaterial},
        {path: '/express/list', component: ExpressList},
        {path: '/block/list', component: BlockList},
        {path: '/block/item', component: BlockItem},
        {path: '/ad/list', component: AdList},
        {path: '/refundreason', component: RefundReason},
        {path: '/refund/list', component: RefundList},
        {path: '/refund/detail', component: RefundDetail},
        {path: '/live/list', component: LiveList},
        {path: '/live/edit', component: LiveEdit},
        {path: '/live/channel', component: LiveChannel},
        {path: '/live/admins', component: LiveAdmins},
        {path: '/live/invite', component: LiveInvite},
        {path: '/video/list', component: VideoList},
        {path: '/menu/list', component: MenuList},
        {path: '/menu/item', component: MenuItem},
        {path: '/shop/refundaddress', component: RefundAddress},
        {
            path: '*',
            component: () => require('./error/404')
        }
    ]
});

module.exports = router;
