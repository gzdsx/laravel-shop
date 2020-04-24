import AdminIndex from "./index/AdminIndex";
import SettingMain from "./settings/SettingMain";
import UserList from "./user/UserList";
import ItemList from "./item/ItemList";
import ItemEdit from "./item/ItemEdit";
import ItemCatlog from "./item/ItemCatlog";
import PostList from "./post/PostList";
import PostEdit from "./post/PostEdit";
import PostCatlog from "./post/PostCatlog";
import PagesList from "./pages/PagesList";
import PagesEdit from "./pages/PagesEdit";
import MaterialList from "./other/MaterialList";
import LinkList from "./other/LinkList";
import DistrictList from "./other/DistrictList";
import OrderList from "./order/OrderList";
import OrderDetail from "./order/OrderDetail";
import TransactionList from "./transaction/TransactionList";
import WechatMenu from "./wechat/WechatMenu";
import WechatMaterial from "./wechat/WechatMaterial";
import Express from "./other/Express";
import BlockList from "./block/BlockList";
import BlockItem from "./block/BlockItem";
import Ad from "./other/Ad";
import Video from "./other/Video";
import FreightList from "./freight/FreightList";
import FreightSet from "./freight/FreightSet";


const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: AdminIndex,
            meta: {title: '后台管理中心'},
        },
        {path: '/settings', component: SettingMain, meta: {title: '店铺设置'}},
        {path: '/freight/index', component: FreightList, meta: {title: '运费设置'}},
        {path: '/freight/edit', component: FreightSet, meta: {title: '编辑模板'}},
        {path: '/freight/edit/:template_id', component: FreightSet, meta: {title: '编辑模板'}},
        {
            path: '/user',
            component: UserList,
            children: [
                {
                    path: 'list',
                    component: UserList,
                }
            ]
        },
        {path: '/item', component: ItemList,},
        {path: '/item/list', component: ItemList,},
        {path: '/item/edit', component: ItemEdit,},
        {path: '/item/edit/:itemid', component: ItemEdit},
        {path: '/item/catlog', component: ItemCatlog},
        //post
        {path: '/post', component: PostList},
        {path: '/post/list', component: PostList},
        {path: '/post/edit', component: PostEdit},
        {path: '/post/edit/:aid', component: PostEdit},
        {path: '/post/catlog', component: PostCatlog},
        //pages
        {path: '/pages', component: PagesList},
        {path: '/pages/list', component: PagesList},
        {path: '/pages/edit', component: PagesEdit},
        {path: '/pages/edit/:pageid', component: PagesEdit},
        {path: '/material', component: MaterialList},
        {path: '/link', component: LinkList},
        {path: '/district', component: DistrictList},
        {path: '/order', component: OrderList},
        {path: '/order/list', component: OrderList},
        {path: '/order/detail/:order_id', component: OrderDetail},
        {path: '/transaction', component: TransactionList},
        {path: '/transaction/list', component: TransactionList},
        {path: '/wechat/menu', component: WechatMenu},
        {path: '/wechat/material', component: WechatMaterial},
        {path: '/express', component: Express},
        {path: '/block/list', component: BlockList},
        {path: '/block/item/:block_id', component: BlockItem},
        {path: '/ad', component: Ad},
        {path: '/video', component: Video},
        {
            path: '*',
            component: () => require('./error/404')
        }
    ]
});

module.exports = router;
