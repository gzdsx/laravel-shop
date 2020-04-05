<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{trans('admin.title')}}</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/iconfont/iconfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/admin/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="admin-header">
    <div class="header">
        <strong class="logo">后台管理中心</strong>
        <div class="right-menu">
            <a href="{{url('/')}}" target="_blank">网站首页</a>
            <a href="{{admin_url('logout')}}">退出登录</a>
        </div>
    </div>
</div>
<div class="sidebar">
    <div class="sidebar-content">
        <div class="scroll">
            <div class="menus" id="menus">
                @if (admin_has_priv('system'))
                    <dl>
                        <dd><a><i class="iconfont icon-radioboxfill"></i>系统设置</a></dd>
                        <dt>
                            <ul>
                                <li><a rel="item" data-action="{{admin_url('settings/basic')}}">基本设置</a></li>
                                <li><a rel="item" data-action="{{admin_url('settings/register')}}">注册设置</a></li>
                                <li><a rel="item" data-action="{{admin_url('settings/attach')}}">附件设置</a></li>
                                <li><a rel="item" data-action="{{admin_url('settings/water')}}">图片水印</a></li>
                            </ul>
                        </dt>
                    </dl>
                @endif
                @if (admin_has_priv('user'))
                        <dl>
                            <dd><a><i class="iconfont icon-peoplefill"></i>用户管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('user')}}">用户列表</a></li>
                                    <li><a rel="item" data-action="{{admin_url('usergroup')}}">分组管理</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif
                @if (admin_has_priv('face'))
                        <dl>
                            <dd><a><i class="iconfont icon-attentionfill"></i>界面管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('menu')}}">菜单管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('ad')}}">广告管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('block')}}">模块管理</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif

                @if (admin_has_priv('item'))
                        <dl>
                            <dd><a><i class="iconfont icon-presentfill"></i>商品管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('item/edit')}}">发布商品</a></li>
                                    <li><a rel="item" data-action="{{admin_url('item')}}">商品列表</a></li>
                                    <li><a rel="item" data-action="{{admin_url('item/catlog')}}">商品分类</a></li>
                                    <li><a rel="item" data-action="{{admin_url('item/catlog/merge')}}">合并分类</a></li>
                                    <li><a rel="item" data-action="{{admin_url('item/reviews')}}">商品评论</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif
                @if (admin_has_priv('trade'))
                        <dl>
                            <dd><a><i class="iconfont icon-rechargefill"></i>交易管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('order')}}">订单记录</a></li>
{{--                                    <li><a rel="item" data-action="{{admin_url('transaction')}}">交易记录</a></li>--}}
                                </ul>
                            </dt>
                        </dl>
                @endif

                @if (admin_has_priv('post'))
                        <dl>
                            <dd><a><i class="iconfont icon-newsfill"></i>文章管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('post/newpost')}}">发布文章</a></li>
                                    <li><a rel="item" data-action="{{admin_url('post')}}">文章列表</a></li>
                                    <li><a rel="item" data-action="{{admin_url('post/catlog')}}">分类管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('post/catlog/merge')}}">合并分类</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif

                @if (admin_has_priv('weixin'))
                        <dl>
                            <dd><a><i class="iconfont icon-messagefill"></i>微信公众号</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('settings/wechat')}}">关注设置</a></li>
                                    <li><a rel="item" data-action="{{admin_url('wechat/menu')}}">菜单设置</a></li>
                                    <li><a rel="item" data-action="{{admin_url('wechat/material')}}">素材管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('wechat/news')}}">图文消息</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif

                @if (admin_has_priv('pages'))
                        <dl>
                            <dd><a><i class="iconfont icon-babyfill"></i>页面管理</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('pages/newpage')}}">新建页面</a></li>
                                    <li><a rel="item" data-action="{{admin_url('pages')}}">页面列表</a></li>
                                    <li><a rel="item" data-action="{{admin_url('pages/category')}}">页面分类</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif

                @if (admin_has_priv('other'))
                        <dl>
                            <dd><a><i class="iconfont icon-tagfill"></i>其他项目</a></dd>
                            <dt>
                                <ul>
                                    <li><a rel="item" data-action="{{admin_url('material')}}">素材管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('district')}}">区域管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('express')}}">快递管理</a></li>
                                    <li><a rel="item" data-action="{{admin_url('link')}}">友情链接</a></li>
                                    <li><a rel="item" data-action="{{admin_url('refundreason')}}">退款理由</a></li>
                                </ul>
                            </dt>
                        </dl>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="mainframe">
    <div class="main-content"><iframe name="mainframe" id="mainframe" src="{{admin_url('wellcome')}}" frameborder="0" style="width: 100%; height: 100%; position: absolute; display: block;"></iframe></div>
</div>
<script type="text/javascript">
    $("#menus dl").each(function () {
        var self = this;
        $(this).find('dd').on('click', function () {
            $(self).find('dt').toggle();
        });
    });
    $("a[rel=item]").on('click', function () {
        $("#mainframe").attr('src', $(this).attr('data-action'));
        $("a[rel=item]").removeClass('cur');
        $(this).addClass('cur');
    });
</script>
</body>
</html>
