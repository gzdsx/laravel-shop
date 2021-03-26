<template>
    <div class="container">
        <div class="user-head" v-if="auth.isSignined">
            <img :src="auth.userinfo.avatar" class="avatar" alt="">
            <div class="username">
                <h3>{{auth.userinfo.username}}</h3>
                <div class="uid">会员ID:{{auth.userinfo.uid}}</div>
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
            <van-cell title="我的订单" is-link value="全部订单" to="/order/list"/>
        </van-cell-group>
        <div class="order-states">
            <router-link to="/order/list?tab=waitPay" class="order-action">
                <span class="iconfont icon-pay"></span>
                <p>待付款</p>
            </router-link>
            <router-link to="/order/list?tab=waitSend" class="order-action">
                <span class="iconfont icon-send1"></span>
                <p>待发货</p>
            </router-link>
            <router-link to="/order/list?tab=waitConfirm" class="order-action">
                <span class="iconfont icon-deliver"></span>
                <p>待收货</p>
            </router-link>
            <router-link to="/order/list?tab=waitRate" class="order-action">
                <span class="iconfont icon-evaluate"></span>
                <p>待评价</p>
            </router-link>
            <router-link to="/refund/list" class="order-action">
                <span class="iconfont icon-refund"></span>
                <p>退款/售后</p>
            </router-link>
        </div>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell is-link title="账户安全" size="large" to="/security">
                <img :src="icons.a" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="收货地址" size="large" to="/address">
                <img :src="icons.b" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="我的收藏" size="large" to="/favorite">
                <img :src="icons.c" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="关于我们" size="large" :url="'/h5/page/33.html'">
                <img :src="icons.d" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="帮组与反馈" size="large" to="/feedback">
                <img :src="icons.e" class="cell-icon" slot="icon" alt="">
            </van-cell>
        </van-cell-group>
        <tab-bar activeIndex="3"/>
    </div>
</template>

<script>

    import {mapState } from 'vuex';
    import TabBar from "../common/TabBar";

    export default {
        name: "UserApp",
        components: {TabBar},
        data() {
            return {
                icons: {
                    a: '/images/app/user/safe.png',
                    b: '/images/app/user/address.png',
                    c: '/images/app/user/favorite.png',
                    d: '/images/app/user/about.png',
                    e: '/images/app/user/feedback.png',
                }
            }
        },
        computed: {
            ...mapState(['auth'])
        },
        mounted() {

        }
    }
</script>

<style scoped>
    .cell-icon {
        width: 25px;
        height: 25px;
        margin-right: 8px;
    }
</style>
