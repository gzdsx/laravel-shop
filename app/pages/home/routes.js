import AddressAdmin from "./address/AddressAdmin";
import AddressEdit from "./address/AddressEdit";
import FeedBack from "./FeedBack";
import NoticeSet from "./NoticeSet";
import Favorite from "./Favorite";
import UserProfile from "./UserProfile";
import Security from "./security/Security";
import EditPass from "./security/EditPass";
import EditPhone from "./security/EditPhone";
import EditEmail from "./security/EditEmail";

module.exports = [
    {name: 'address-admin', component: AddressAdmin},
    {name: 'address-edit', component: AddressEdit},
    {name: 'feed-back', component: FeedBack},
    {name: 'notice-set', component: NoticeSet},
    {name: 'favorite', component: Favorite},
    {name: 'user-profile', component: UserProfile},
    {name: 'security', component: Security},
    {name: 'resetpassword', component: EditPass},
    {name: 'edit-phone', component: EditPhone},
    {name: 'edit-email', component: EditEmail},
]
