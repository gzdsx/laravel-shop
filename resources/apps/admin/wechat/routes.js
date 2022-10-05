import WechatMenu from "./WechatMenu";
import WechatMaterial from "./WechatMaterial";

module.exports = [
    {path: '/wechat/menu', component: WechatMenu, meta: {title: '菜单管理', group: 'wechat'}},
    {path: '/wechat/material', component: WechatMaterial, meta: {title: '素材管理', group: 'wechat'}},
]
