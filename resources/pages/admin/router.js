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
import MaterialList from "./material/MaterialList";
import LinkList from "./link/LinkList";
import DistrictList from "./district/DistrictList";


const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: AdminIndex,
            meta: {title: '后台管理中心'},
        },
        {
            path: '/settings',
            component: SettingMain,
            meta: {title: '店铺设置'}
        },
        {
            path: '/user',
            component: UserList,
            children:[
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
        {path:'/pages',component:PagesList},
        {path:'/pages/list',component:PagesList},
        {path:'/pages/edit',component:PagesEdit},
        {path:'/pages/edit/:pageid',component:PagesEdit},
        {path:'/material',component:MaterialList},
        {path:'/link',component:LinkList},
        {path:'/district',component:DistrictList},
        {
            path: '*',
            component: ()=>require('./error/404')
        }
    ]
});

module.exports = router;
