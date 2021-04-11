<template>
    <div class="area user-content">
        <div class="sidebar">
            <div class="sidebar-content">
                <dl>
                    <dd><a><i class="iconfont icon-formfill"></i>订单管理</a></dd>
                    <dt>
                        <ul>
                            <li>
                                <router-link to="/bought">已买到的宝贝</router-link>
                            </li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-peoplefill"></i>我的账户</a></dd>
                    <dt>
                        <ul>
                            <li>
                                <router-link to="/userinfo">资料设置</router-link>
                            </li>
                            <li>
                                <router-link to="/security">账户安全</router-link>
                            </li>
                            <li>
                                <router-link to="/bill">我的账单</router-link>
                            </li>
                            <li>
                                <router-link to="/address">收货地址</router-link>
                            </li>
                            <li>
                                <router-link to="/collect">我的收藏</router-link>
                            </li>
                        </ul>
                    </dt>
                </dl>
            </div>
        </div>
        <div class="mainframe">
            <div class="mainframe-content">
                <div id="app">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Main",
        mounted() {
            this.$get('/user/info').then(response => {
                this.$store.commit('signin', response.result.userinfo);
            })
        }
    }
</script>

<style scoped>

</style>
