import ProductList from "./ProductList";
import ProductEdit from "./ProductEdit";
import ProductTemplateList from "./ProductTemplateList";
import ProductTemplateEdit from "./ProductTemplateEdit";
import ProductAttr from "./ProductAttr";
import ProductAttrValue from "./ProductAttrValue";
import ProductCategory from "./ProductCategory";
import RefundAddress from "./RefundAddress";
import RefundReason from "./RefundReason";
import ShopList from "./ShopList";
import ShopEdit from "./ShopEdit";
import Coupon from "./Coupon";
import ProductModel from "./ProductModel";


module.exports = [
    {path: '/product/list', component: ProductList, meta: {title: '商品管理', group: 'ecom'}},
    {path: '/product/edit/:itemid?', component: ProductEdit, meta: {title: '编辑商品', group: 'ecom'}},
    {path: '/product/category', component: ProductCategory, meta: {title: '商品分类', group: 'ecom'}},
    {path: '/product/template/list', component: ProductTemplateList, meta: {title: '运费模板', group: 'ecom'}},
    {path: '/product/template/edit', component: ProductTemplateEdit, meta: {title: '编辑模板', group: 'ecom'}},
    {path: '/shop/list', component: ShopList, meta: {title: '门店管理', group: 'ecom'}},
    {path: '/shop/edit/:shop_id?', component: ShopEdit, meta: {title: '编辑门店', group: 'ecom'}},
    {path: '/refund/address', component: RefundAddress, meta: {title: '退货地址', group: 'ecom'}},
    {path: '/refund/reason', component: RefundReason, meta: {title: '退货理由', group: 'ecom'}},
    {path: '/ecom/coupon', component: Coupon, meta: {title: '优惠券管理', group: 'ecom'}},
    {path: '/ecom/product-model', component: ProductModel, meta: {title: '型号管理', group: 'ecom'}},
    {path: '/ecom/product-attr', component: ProductAttr, meta: {title: '商品型号', group: 'ecom'}},
    {path: '/ecom/product-attrvalue', component: ProductAttrValue, meta: {title: '商品型号', group: 'ecom'}},

]
