<template>
    <div class="container">
        <div class="user-head" v-if="isSignined">
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
            <van-cell is-link title="我的会员" size="large" center to="/member">
                <img :src="icons.a" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="绑定联系人" size="large" center to="/user/bindsupervior">
                <img :src="icons.b" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="联系客服" size="large" center to="/kefu/list">
                <img :src="icons.c" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="我的设置" size="large" center to="/user/setting">
                <img :src="icons.d" class="cell-icon" slot="icon" alt="">
            </van-cell>
            <van-cell is-link title="我的钱包" size="large" center to="/wallet">
                <img :src="icons.e" class="cell-icon" slot="icon" alt="">
            </van-cell>
        </van-cell-group>
        <tab-bar activeIndex="2"/>
    </div>
</template>

<script>

    import {mapState} from 'vuex';
    import TabBar from "../common/TabBar";

    export default {
        name: "UserApp",
        components: {TabBar},
        data() {
            return {
                icons: {
                    a: '/images/app/user/huiyuan.png',
                    b: '/images/app/user/bangding.png',
                    c: '/images/app/user/kefu.png',
                    d: '/images/app/user/shezhi.png',
                    e: '/images/app/user/qianbao.png',
                }
            }
        },
        computed: {
            ...mapState(['isSignined', 'userInfo'])
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
