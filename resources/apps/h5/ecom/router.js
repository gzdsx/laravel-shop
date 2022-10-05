import Cart from "./Cart";
import ProductIndex from "./ProductIndex";
import ProductList from "./ProductList";
import ProductDetail from "./ProductDetail";
import ProductCategory from "./ProductCategory";


module.exports = [
    {path: '/cart', component: Cart, meta: {title: '购物车', auth: false}},
    {path: '/product/index', component: ProductIndex, meta: {title: '商城', auth: false}},
    {path: '/product/list', component: ProductList, meta: {title: '商品列表', auth: false}},
    {path: '/product/category', component: ProductCategory, meta: {title: '商品分类', auth: false}},
    {path: '/product/detail/:itemid', component: ProductDetail, meta: {title: '商品详情', auth: false}},
]
