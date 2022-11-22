import ProductList from "./ProductList";
import ProductDetail from "./ProductDetail";
import ConfirmOrder from "./ConfirmOrder";
import BuyNow from "./BuyNow";
import Cart from "./Cart";
import ShopDetail from "./ShopDetail";
import ShopMap from "./ShopMap";
import Search from "./Search";

module.exports = [
    {name: 'product-list', component: ProductList},
    {name: 'product-detail', component: ProductDetail},
    {name: 'confirm-order', component: ConfirmOrder},
    {name: 'buynow', component: BuyNow},
    {name: 'cart', component: Cart},
    {name: 'shop-detail', component: ShopDetail},
    {name: 'shop-map', component: ShopMap},
    {name: 'ecom-search', component: Search},
]
