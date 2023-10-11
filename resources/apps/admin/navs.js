export default [
    {
        name: '仪表板',
        icon: 'speedometer',
        children: [
            {
                name: '后台首页',
                path: '/',
                isLink: false
            }
        ]
    },
    {
        name: '设置',
        icon: 'gear-wide',
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
        icon: 'people',
        children: [
            {
                name: '新增用户',
                path: '/user/edit',
                isLink: false,
                visible: true
            },
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
            }
        ]
    },
    {
        name: '电商',
        icon: 'bag',
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
        icon: 'r-circle',
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
        icon: 'pencil-square',
        children: [
            {
                name: '添加文章',
                path: '/post/edit',
                isLink: false
            },
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
        icon: 'box',
        children: [
            {
                name: '新建页面',
                path: '/page/edit',
                isLink: false
            },
            {
                name: '页面管理',
                path: '/page/list',
                isLink: false
            }
        ]
    },
    {
        name: '微信公众号',
        icon: 'wechat',
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
        icon: 'compass',
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
                name: '图文模块',
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
