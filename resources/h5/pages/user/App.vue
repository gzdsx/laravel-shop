<template>
    <div class="container">
        <div class="user-head" v-if="userData">
            <img :src="userData.avatar" class="avatar">
            <div class="username">
                <h3>{{userData.username}}</h3>
                <div class="uid">会员ID:{{userData.uid}}</div>
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
            <van-cell title="我的订单" is-link value="全部订单"/>
        </van-cell-group>
        <div class="order-states">
            <div class="order-action">
                <span class="iconfont icon-pay"></span>
                <p>待付款</p>
            </div>
            <div class="order-action">
                <span class="iconfont icon-send1"></span>
                <p>待发货</p>
            </div>
            <div class="order-action">
                <span class="iconfont icon-deliver"></span>
                <p>待收货</p>
            </div>
            <div class="order-action">
                <span class="iconfont icon-evaluate"></span>
                <p>待评价</p>
            </div>
            <div class="order-action">
                <span class="iconfont icon-refund"></span>
                <p>退款/售后</p>
            </div>
        </div>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell is-link title="账户安全" size="large">
                <img :src="icons.a" class="cell-icon" slot="icon">
            </van-cell>
            <van-cell is-link title="收货地址" size="large" url="/h5/address">
                <img :src="icons.b" class="cell-icon" slot="icon">
            </van-cell>
            <van-cell is-link title="我的收藏" size="large">
                <img :src="icons.c" class="cell-icon" slot="icon">
            </van-cell>
            <van-cell is-link title="关于我们" size="large">
                <img :src="icons.d" class="cell-icon" slot="icon">
            </van-cell>
            <van-cell is-link title="帮组与反馈" size="large">
                <img :src="icons.e" class="cell-icon" slot="icon">
            </van-cell>
        </van-cell-group>
        <tab-bar activeIndex="3"/>
    </div>
</template>

<script>
    import {Cell, CellGroup, Col, Row} from 'vant';
    import TabBar from "../../components/TabBar";

    Vue.use(Cell);
    Vue.use(CellGroup);
    Vue.use(Col);
    Vue.use(Row);

    export default {
        name: "App",
        components: {TabBar},
        data: function () {
            return {
                userData,
                icons:{
                    a:imgPath+'/h5/user/anquan.png',
                    b:imgPath+'/h5/user/huiyuan.png',
                    c:imgPath+'/h5/user/favorite.png',
                    d:imgPath+'/h5/user/about.png',
                    e:imgPath+'/h5/user/help.png',
                }
            }
        },
        comments: {
            'tab-bar': TabBar
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
