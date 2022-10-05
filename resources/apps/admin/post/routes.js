import PostList from "./PostList";
import PostEdit from "./PostEdit";
import Category from "./Category";

module.exports = [
    {path: '/post/list', component: PostList, meta: {title: '文章管理', group: 'post'}},
    {path: '/post/edit/:aid?', component: PostEdit, meta: {title: '编辑文章', group: 'post'}},
    {path: '/post/category', component: Category, meta: {title: '分类管理', group: 'post'}},
]
