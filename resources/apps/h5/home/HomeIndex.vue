<template>
    <div class="container">
        <div class="user-head" v-if="$store.state.isSignined">
            <img :src="userInfo.avatar" class="avatar" alt="">
            <div class="username">
                <h3>{{userInfo.username}}</h3>
                <div class="uid">会员ID:{{userInfo.uid}}</div>
            </div>
        </div>
        <div class="user-head" v-else>
            <div class="avatar"></div>
            <div class="username">
                <h3>未登录</h3>
                <div class="uid">登录享受更多服务</div>
            </div>
        </div>
        <van-cell-group>
            <van-cell title="我的订单" is-link value="全部订单" to="/bought/list"/>
        </van-cell-group>
        <div class="order-states">
            <router-link to="/bought/list?tab=waitSend" class="order-action">
                <div>
                    <img src="/images/app/order/wait-send.png" alt="">
                </div>
                <p>待发货</p>
            </router-link>
            <div class="flex-fill"></div>
            <router-link to="/bought/list?tab=waitConfirm" class="order-action">
                <div>
                    <img src="/images/app/order/wait-confirm.png" alt="">
                </div>
                <p>待收货</p>
            </router-link>
            <div class="flex-fill"></div>
            <router-link to="/bought/list?tab=completed" class="order-action">
                <div>
                    <img src="/images/app/order/complete.png" alt="">
                </div>
                <p>已完成</p>
            </router-link>
        </div>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell v-for="(nav,index) in navs"
                      :key="index"
                      :title="nav.title"
                      size="large"
                      is-link
                      center
                      :to="nav.link"
            >
                <img :src="nav.icon" class="cell-icon" slot="icon" alt="">
            </van-cell>
        </van-cell-group>
        <tab-bar :active-index="4"/>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";

    export default {
        name: "UserApp",
        components: {TabBar},
        data() {
            return {
                navs: [
                    {
                        title: '我的会员',
                        icon: '/images/app/user/huiyuan.png',
                        link: '/member/index'
                    },
                    {
                        title: '我的地址',
                        icon: '/images/app/user/dizhi.png',
                        link: '/home/address'
                    },
                    {
                        title: '营销推广',
                        icon: '/images/app/user/fenxiao.png',
                        link: '/fenxiao/index'
                    },
                    {
                        title: '联系客服',
                        icon: '/images/app/user/kefu.png',
                        link: '/home/kefu'
                    },
                    {
                        title: '我的钱包',
                        icon: '/images/app/user/qianbao.png',
                        link: '/home/wallet'
                    },
                    {
                        title: '个人设置',
                        icon: '/images/app/user/shezhi.png',
                        link: '/home/user-setting'
                    }
                ]
            }
        },
        computed: {
            userInfo() {
                return this.$store.state.userInfo;
            }
        },
        mounted() {
            this.setBackgroundColor('#f5f5f5');
        }
    }
</script>

<style scoped>
    .van-cell--large {
        padding-top: 16px;
        padding-bottom: 16px;
    }

    .cell-icon {
        width: 25px;
        height: 25px;
        margin-right: 8px;
    }
</style>
