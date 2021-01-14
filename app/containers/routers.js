import TabBar from "./TabBar";
import AboutUs from "../pages/user/AboutUs";
import FeedBack from "../pages/user/FeedBack";
import Favorite from "../pages/user/Favorite";
import Security from "../pages/user/security/Security";
import EditEmail from "../pages/user/security/EditEmail";
import EditMobile from "../pages/user/security/EditMobile";
import EditPass from "../pages/user/security/EditPass";
import MyProfile from "../pages/user/profile/MyProfile";
import NoticeSet from "../pages/user/NoticeSet";
import Signin from "../pages/auth/Signin";
import Signup from "../pages/auth/Signup";
import AMapView from "../pages/common/AMapView";
import QRScanner from "../pages/common/QRScanner";
import DistrictSelector from "../pages/common/DistrictSelector";
import VideoIndex from "../pages/video/VideoIndex";
import VideoDetail from "../pages/video/VideoDetail";
import RecordVideo from "../pages/video/RecordVideo";
import LiveIndex from "../pages/live/LiveIndex";
import LivePlay from "../pages/live/LivePlay";
//shop
import ItemIndex from "../pages/shop/ItemIndex";
import ItemList from "../pages/shop/ItemList";
import ItemDetail from "../pages/shop/ItemDetail";
import Category from "../pages/shop/Category";
import BuyNow from "../pages/order/BuyNow";
import ConfirmOrder from "../pages/order/ConfirmOrder";
import Logistics from "../pages/order/Logistics";
import OrderRate from "../pages/order/OrderRate";
import OrderList from "../pages/bought/OrderList";
import OrderDetail from "../pages/bought/OrderDetail";
import AddressList from "../pages/user/address/AddressList";
import AddressEdit from "../pages/user/address/AddressEdit";
//post
import PostDetail from "../pages/post/PostDetail";
//refund
import RefundList from "../pages/refund/RefundList";
import RefundRouter from "../pages/refund/RefundRouter";
import RefundApply from "../pages/refund/RefundApply";
import RefundSend from "../pages/refund/RefundSend";
import RefundDetail from "../pages/refund/RefundDetail";



export default [
    {name: 'TabBar', component: TabBar, options: {headerShown: false,}},
    {name: 'AboutUs', component: AboutUs, options: AboutUs.navigationOptions || {}},
    {name: 'FeedBack', component: FeedBack, options: FeedBack.navigationOptions || {}},
    {name: 'Favorite', component: Favorite, options: Favorite.navigationOptions || {}},
    {name: 'Security', component: Security, options: Security.navigationOptions || {}},
    {name: 'EditEmail', component: EditEmail, options: EditEmail.navigationOptions || {}},
    {name: 'EditMobile', component: EditMobile, options: EditMobile.navigationOptions || {}},
    {name: 'EditPass', component: EditPass, options: EditPass.navigationOptions || {}},
    {name: 'MyProfile', component: MyProfile, options: MyProfile.navigationOptions || {}},
    {name: 'NoticeSet', component: NoticeSet, options: NoticeSet.navigationOptions || {}},
    {name: 'Signin', component: Signin, options: Signin.navigationOptions || {}},
    {name: 'Signup', component: Signup, options: Signup.navigationOptions || {}},
    {name: 'AMapView', component: AMapView, options: AMapView.navigationOptions || {}},
    {name: 'QRScanner', component: QRScanner, options: QRScanner.navigationOptions || {}},
    {name: 'DistrictSelector', component: DistrictSelector, options: DistrictSelector.navigationOptions || {}},
    {name: 'VideoIndex', component: VideoIndex, options: VideoIndex.navigationOptions || {}},
    {name: 'VideoDetail', component: VideoDetail, options: VideoDetail.navigationOptions || {}},
    {name: 'RecordVideo', component: RecordVideo, options: RecordVideo.navigationOptions || {}},
    {name: 'LiveIndex', component: LiveIndex, options: LiveIndex.navigationOptions || {}},
    {name: 'LivePlay', component: LivePlay, options: LivePlay.navigationOptions || {}},
    //shop
    {name: 'ItemIndex', component: ItemIndex},
    {name: 'ItemList', component: ItemList},
    {name: 'ItemDetail', component: ItemDetail},
    {name: 'Category', component: Category},
    //order
    {name: 'BuyNow', component: BuyNow},
    {name: 'ConfirmOrder', component: ConfirmOrder},
    {name: 'Logistics', component: Logistics},
    {name: 'OrderRate', component: OrderRate},
    {name: 'OrderList', component: OrderList},
    {name: 'OrderDetail', component: OrderDetail},
    {name: 'AddressList', component: AddressList},
    {name: 'AddressEdit', component: AddressEdit},
    //post
    {name: 'PostDetail', component: PostDetail},
    //refund
    {name: 'RefundList', component: RefundList},
    {name: 'RefundRouter', component: RefundRouter},
    {name: 'RefundApply', component: RefundApply},
    {name: 'RefundSend', component: RefundSend},
    {name: 'RefundDetail', component: RefundDetail},
];