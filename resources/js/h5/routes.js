import App from './App';
import ItemDetail from './item/ItemDetail';

export default [
    {
        path:'/',
        component:App,
    },
    {
        path:'/item/detail/:itemid',
        component: ItemDetail
    },
];
