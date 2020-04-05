<template>
    <div class="container">
        <div class="swipe-wrapper">
            <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
                <van-swipe-item v-for="(img,index) in item_DATA.images" :key="index">
                    <div class="bg-cover swipe-image" :style="'background-image: url('+img.image+');'"></div>
                </van-swipe-item>
            </van-swipe>
        </div>

        <div class="goods-info">
            <div class="title">{{item_DATA.title}}</div>
            <div class="subtitle">{{item_DATA.subtitle}}</div>
            <div class="display-flex">
                <div class="price flex">￥{{item_DATA.price}}</div>
                <div class="sold">已售{{item_DATA.sold}}件</div>
            </div>
        </div>

        <div class="goods-desc">
            <div class="title">商品详情</div>
            <div class="content" v-html="item_DATA.content.content"></div>
        </div>
        <div class="h50"></div>
        <van-goods-action>
            <van-goods-action-icon icon="chat-o" text="客服"/>
            <van-goods-action-icon icon="cart-o" text="购物车" url="/h5/cart"/>
            <van-goods-action-button type="warning" text="加入购物车" @click="addToCart"/>
            <van-goods-action-button type="danger" text="立即购买" :url="'/h5/order/buynow?itemid='+item_DATA.itemid"/>
        </van-goods-action>
    </div>
</template>

<script>
    export default {
        name: "App",
        data: function () {
            return {
                item_DATA
            }
        },
        methods: {
            addToCart: function () {
                var _this = this;
                this.$axios.post('/h5/cart/add', {itemid: item_DATA.itemid}).then(response => {
                    _this.$toast.success('已加入购物车');
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .swipe-wrapper {
        padding-top: 80%;
        position: relative;

        .swipe {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;

            &-image {
                width: 100%;
                height: 100%;
            }
        }
    }
</style>
