import UserList from "./UserList";
import UserEdit from "./UserEdit";
import UserGroup from "./UserGroup";
import AdminGroup from "./AdminGroup";
import AdminUser from "./AdminUser";

module.exports = [
    {path: '/user/list', component: UserList, meta: {title: '用户管理', group: 'user'}},
    {path: '/user/edit/:uid?', component: UserEdit, meta: {title: '编辑用户', group: 'user'}},
    {path: '/user/group', component: UserGroup, meta: {title: '分组管理', group: 'user'}},
    {path: '/admin/user', component: AdminUser, meta: {title: '管理员管理', group: 'user'}},
    {path: '/admin/group', component: AdminGroup, meta: {title: '管理员分组', group: 'user'}},
]
