import PageList from "./PageList";
import PageEdit from "./PageEdit";

module.exports = [
    {path: '/page/list', component: PageList, meta: {title: '页面管理', group: 'page'}},
    {path: '/page/edit/:id?', component: PageEdit, meta: {title: '编辑页面', group: 'page'}},
]
