import ExpressList from "./ExpressList";
import BlockList from "./BlockList";
import BlockItem from "./BlockItem";
import AdList from "./AdList";
import MenuList from "./MenuList";
import MenuItem from "./MenuItem";
import LabelList from "./LabelList";
import MaterialList from "./MaterialList";
import LinkList from "./LinkList";
import DistrictList from "./DistrictList";
import KefuList from "./KefuList";

module.exports = [
    {path: '/express/list', component: ExpressList, meta: {title: '快递管理', group: 'common'}},
    {path: '/block/list', component: BlockList, meta: {title: '模块管理', group: 'common'}},
    {path: '/block/item/:block_id?', component: BlockItem, meta: {title: '项目管理', group: 'common'}},
    {path: '/ad/list', component: AdList, meta: {title: '广告管理', group: 'common'}},
    {path: '/menu/list', component: MenuList, meta: {title: '菜单管理', group: 'common'}},
    {path: '/menu/item/:menu_id?', component: MenuItem, meta: {title: '项目管理', group: 'common'}},
    {path: '/label/list', component: LabelList, meta: {title: '自定义标签', group: 'common'}},
    {path: '/material/list', component: MaterialList, meta: {title: '素材管理', group: 'common'}},
    {path: '/link/list', component: LinkList, meta: {title: '链接管理', group: 'common'}},
    {path: '/district/list', component: DistrictList, meta: {title: '区位管理', group: 'common'}},
    {path: '/kefu/list', component: KefuList, meta: {title: '客服管理', group: 'common'}},
]
