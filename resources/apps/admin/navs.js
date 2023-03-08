export default [
    {
        name: '首页',
        fullName: '首页',
        icon: 'icon-home',
        path: '/',
        group: 'home',
        children: [
            {
                name: '后台首页',
                path: '/',
                isLink: false
            },
            {
                name: '网站首页',
                path: '/',
                isLink: true
            },
        ]
    },
    {
        name: '设置',
        fullName: '系统设置',
        icon: 'icon-setting',
        path: '/settings',
        group: 'settings',
        children: [
            {
                name: '参数设置',
                path: '/settings',
                isLink: false
            },
        ]
    },
    {
        name: '用户',
        fullName: '用户管理',
        icon: 'icon-people',
        path: '/user/list',
        group: 'user',
        children: [
            {
                name: '用户列表',
                path: '/user/list',
                isLink: false,
                visible: true
            },
            {
                name: '用户分组',
                path: '/user/group',
                isLink: false,
                visible: true
            },
            {
                name: '管理员管理',
                path: '/admin/user',
                isLink: false,
                visible: true
            },
            {
                name: '管理员分组',
                path: '/admin/group',
                isLink: false,
                visible: true
            },
        ]
    },
    {
        name: '电商',
        fullName: '商品管理',
        icon: 'icon-goodsnew',
        path: '/product/list',
        group: 'ecom',
        children: [
            {
                name: '商品管理',
                path: '/product/list',
                isLink: false
            },
            {
                name: '商品分类',
                path: '/product/category',
                isLink: false
            },
            {
                name: '商品型号',
                path: '/ecom/product-model',
                isLink: false
            },
            {
                name: '门店管理',
                path: '/shop/list',
                isLink: false
            },
            {
                name: '运费模板',
                path: '/product/template/list',
                isLink: false
            },
            {
                name: '优惠券管理',
                path: '/ecom/coupon',
                isLink: false
            },
        ]
    },
    {
        name: '交易',
        fullName: '交易管理',
        icon: 'icon-recharge',
        path: '/order/list',
        group: 'trade',
        children: [
            {
                name: '订单管理',
                path: '/order/list',
                isLink: false
            },
            {
                name: '退款管理',
                path: '/refund/list',
                isLink: false
            },
            {
                name: '交易流水',
                path: '/transaction/list',
                isLink: false
            },
        ]
    },
    {
        name: '文章',
        fullName: '文章管理',
        icon: 'icon-form',
        path: '/post/list',
        group: 'post',
        children: [
            {
                name: '文章管理',
                path: '/post/list',
                isLink: false
            },
            {
                name: '文章分类',
                path: '/post/category',
                isLink: false
            }
        ]
    },
    {
        name: '页面',
        fullName: '页面管理',
        icon: 'icon-info',
        path: '/page/list',
        group: 'page',
        children: [
            {
                name: '页面列表',
                path: '/page/list',
                isLink: false
            },
            {
                name: '页面分类',
                path: '/page/category',
                isLink: false
            }
        ]
    },
    {
        name: '微信',
        fullName: '微信公众号',
        icon: 'icon-wechat-fill',
        path: '/wechat/menu',
        group: 'wechat',
        children: [
            {
                name: '菜单管理',
                path: '/wechat/menu',
                isLink: false
            },
            {
                name: '素材管理',
                path: '/wechat/material',
                isLink: false
            }
        ]
    },
    {
        name: '其他',
        fullName: '其他',
        icon: 'icon-skin',
        path: '/material/list',
        group: 'common',
        children: [
            {
                name: '素材管理',
                path: '/material/list',
                isLink: false
            },
            {
                name: '链接管理',
                path: '/link/list',
                isLink: false
            },
            {
                name: '区域管理',
                path: '/district/list',
                isLink: false
            },
            {
                name: '内容模块',
                path: '/block/list',
                isLink: false
            },
            {
                name: '广告管理',
                path: '/ad/list',
                isLink: false
            },
            {
                name: '标签管理',
                path: '/label/list',
                isLink: false
            },
            {
                name: '菜单管理',
                path: '/menu/list',
                isLink: false
            },
            {
                name: '快递管理',
                path: '/express/list',
                isLink: false
            },
            {
                name: '客服管理',
                path: '/kefu/list',
                isLink: false
            },
        ]
    },
];
