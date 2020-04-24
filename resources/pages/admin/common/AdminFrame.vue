<template>
    <div class="admin-wrapper">
        <div class="sidebar">
            <div class="sidebar-fixed">
                <div class="sidebar-scroll">
                    <div class="sidebar-profile">
                        <el-dropdown>
                            <div class="el-dropdown-link">
                                <img :src="'images/common/favicon.png'" class="logo" alt="">
                                <div class="sitename">后台管理中心</div>
                                <i class="el-icon-arrow-down el-icon--right"></i>
                            </div>
                            <el-dropdown-menu style="width: 160px;" slot="dropdown">
                                <el-dropdown-item>个人资料</el-dropdown-item>
                                <a href="/admin/logout">
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
                                    <router-link to="/freight/index">运费模板</router-link>
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
                                    <router-link to="/user">用户列表</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/item">
                                    <span class="iconfont icon-goods_light"></span>
                                    <span>商品</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/item/list">商品列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/item/edit">发布商品</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/item/catlog">分类管理</router-link>
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
                                    <router-link to="/transaction/list">支付记录</router-link>
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
                                    <router-link to="/post/edit">添加文章</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/post/catlog">分类管理</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="v-common-nav-model">
                            <div class="v-common-nav-model-link">
                                <router-link to="/pages/list">
                                    <span class="iconfont icon-form_light"></span>
                                    <span>页面</span>
                                </router-link>
                            </div>
                            <div class="v-common-nav-link-wrapper">
                                <div class="v-common-nav-link">
                                    <router-link to="/pages/list">页面列表</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/pages/edit">添加页面</router-link>
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
                                    <router-link to="/material">素材管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/link">链接管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/district">区域管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/express">快递管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/block/list">内容模块</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/ad">广告管理</router-link>
                                </div>
                                <div class="v-common-nav-link">
                                    <router-link to="/video">视频管理</router-link>
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
