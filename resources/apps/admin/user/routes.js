import UserList from "./UserList";
import UserEdit from "./UserEdit";
import UserGroup from "./UserGroup";

module.exports = [
    {path: '/user/list', component: UserList, meta: {title: '用户管理', group: 'user'}},
    {path: '/user/edit/:uid?', component: UserEdit, meta: {title: '编辑用户', group: 'user'}},
    {path: '/user/group', component: UserGroup, meta: {title: '分组管理', group: 'user'}},
]
