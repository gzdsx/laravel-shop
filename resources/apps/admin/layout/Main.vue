<template>
    <div class="admin-page">
        <div class="admin-top">
            <div class="flex-grow-1 logo">
                <img src="/images/admin/logo.png" alt="">
                <h1>后台管理中心</h1>
            </div>
            <div class="v-dropdown">
                <el-dropdown>
                    <a class="el-dropdown-link">
                        <img :src="userInfo.avatar" class="avatar" alt="">
                        <span>{{ userInfo.nickname }}</span>
                    </a>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>
                            <router-link to="/">账号设置</router-link>
                        </el-dropdown-item>
                        <el-dropdown-item>
                            <router-link to="/bill">消费明细</router-link>
                        </el-dropdown-item>
                        <el-dropdown-item>
                            <a href="/" target="_blank">网站首页</a>
                        </el-dropdown-item>
                        <el-dropdown-item divided>
                            <a href="/logout">退出登录</a>
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </div>
        <div class="admin-sidebar">
            <div class="v-common-nav">
                <el-collapse>
                    <el-collapse-item v-for="(nav,index) in navs" :name="index" :key="'nav-'+index">
                        <div class="v-nav-item" slot="title">
                            <i class="v-nav-icon bi" :class="'bi-'+nav.icon"></i>
                            <span>{{ nav.name }}</span>
                        </div>
                        <div class="v-nav-link" v-for="(nav2,idx) in nav.children" :key="'link-'-idx">
                            <a :href="nav2.path" target="_blank" v-if="nav2.isLink">{{ nav2.name }}</a>
                            <router-link :to="nav2.path" v-else>{{ nav2.name }}</router-link>
                        </div>
                    </el-collapse-item>
                </el-collapse>
            </div>
        </div>
        <div class="admin-main">
            <router-view :key="$route.fullPath"/>
        </div>
    </div>
</template>

<script>
import navs from "../navs";

export default {
    name: "Main",
    data() {
        return {
            navs
        }
    },
    computed: {
        userInfo() {
            return this.$store.state.userInfo;
        }
    },
    methods: {},

    mounted() {
        this.navs = navs;
        this.$get('/user/info').then(response => {
            this.$store.commit('signin', response.result);
        });
    },
}
</script>

<style scoped>

</style>
