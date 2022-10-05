import PageList from "./PageList";
import PageEdit from "./PageEdit";
import Category from "./Category";

module.exports = [
    {path: '/page/list', component: PageList, meta: {title: '页面管理', group: 'page'}},
    {path: '/page/edit/:id?', component: PageEdit, meta: {title: '编辑页面', group: 'page'}},
    {path: '/page/category', component: Category, meta: {title: '页面分类', group: 'page'}},
]
