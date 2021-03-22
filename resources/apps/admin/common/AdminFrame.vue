<template>
    <div class="admin-wrapper">
        <div class="sidebar">
            <div class="sidebar-fixed">
                <div class="sidebar-scroll">
                    <div class="sidebar-profile">
                        <el-dropdown>
                            <div class="el-dropdown-link">
                                <img :src="'/images/common/favicon.png'" class="logo" alt="">
                                <div class="sitename">后台管理中心</div>
                                <i class="el-icon-arrow-down el-icon--right"></i>
                            </div>
                            <el-dropdown-menu style="width: 160px;" slot="dropdown">
                                <a href="/user" target="_blank">
                                    <el-dropdown-item>个人资料</el-dropdown-item>
                                </a>
                                <a href="/logout">
                                    <el-dropdown-item>
                                        退出登录
                                    </el-dropdown-item>
                                </a>
                            </el-dropdown-menu>
                        </el-dropdown>
                    </div>
                    <div class="v-common-nav">
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/">
                                    <span class="iconfont icon-home_light"></span>
                                    <span>首页</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/">后台首页</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <a href="/" target="_blank">店铺首页</a>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/settings">
                                    <span class="iconfont icon-shoplight"></span>
                                    <span>设置</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/settings">店铺设置</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/freight/list">运费模板</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/refundreason">退货理由</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/express/list">快递管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/shop/refundaddress">退货地址</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/user/list">
                                    <span class="iconfont icon-people_list_light"></span>
                                    <span>用户</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/user/list">用户列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/user/group">用户分组</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/product/list">
                                    <span class="iconfont icon-goods_light"></span>
                                    <span>商品</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/product/list">商品列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/product/category">分类管理</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/order/list">
                                    <span class="iconfont icon-attention_light"></span>
                                    <span>交易</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/order/list">订单列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/transaction/list">交易流水</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/refund/list">退款处理</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/post">
                                    <span class="iconfont icon-news_light"></span>
                                    <span>文章</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/post/list">文章列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/post/category">文章分类</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/live/list">
                                    <span class="iconfont icon-video_light"></span>
                                    <span>直播</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/live/list">直播话题</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/live/channel">直播频道</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/page/list">
                                    <span class="iconfont icon-form_light"></span>
                                    <span>页面</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/page/list">页面列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/page/category">页面分类</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/wechat/menu">
                                    <span class="iconfont icon-wechat-fill"></span>
                                    <span>微信</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/wechat/menu">菜单管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/wechat/material">素材管理</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <span class="iconfont icon-skin_light"></span>
                                <span>其他</span>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/material/list">素材管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/link/list">链接管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/district/list">区域管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/block/list">内容模块</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/ad/list">广告管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/video/list">视频管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/label/list">标签管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/menu/list">菜单管理</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainframe">
            <div class="mainframe-container">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminFrame"
    }
</script>

<style scoped>

</style>
