<template>
    <buy-now :item="item" :quantity="quantity" :sku="sku" v-if="showBuynow"></buy-now>
    <div class="container" v-else>
        <div class="swipe-wrapper">
            <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
                <van-swipe-item v-for="(img,index) in item.images" :key="index">
                    <div class="bg-cover swipe-image" :style="'background-image: url('+img.image+');'"></div>
                </van-swipe-item>
            </van-swipe>
        </div>

        <div class="goods-info">
            <div class="title">{{item.title}}</div>
            <div class="subtitle">{{item.subtitle}}</div>
            <div class="display-flex">
                <div class="price flex">￥{{item.price}}</div>
                <div class="sold">已售{{item.sold}}件</div>
            </div>
        </div>

        <div class="goods-desc">
            <div class="title">商品详情</div>
            <div class="content" v-html="item.content.content"></div>
        </div>
        <div class="h50"></div>
        <van-goods-action>
            <van-goods-action-icon icon="chat-o" text="客服"/>
            <van-goods-action-icon icon="cart-o" text="购物车" url="/h5/cart"/>
            <van-goods-action-button type="warning" text="加入购物车" @click="handleAddToCart"/>
            <van-goods-action-button type="danger" text="立即购买" @click="handleBuyNow"/>
        </van-goods-action>

        <van-popup v-model="showSku" position="bottom">
            <sku-view :item="item" @addcart="onAddToCart" @buynow="onBuyNow"></sku-view>
        </van-popup>
    </div>
</template>

<script>
    import BuyNow from "./BuyNow";
    import SkuView from "./SkuView";

    export default {
        name: "ItemDetail",
        components: {
            BuyNow,
            SkuView
        },
        data: function () {
            return {
                item,
                showBuynow: false,
                showSku: false,
                sku:null,
                quantity: 1
            }
        },
        methods: {
            handleAddToCart: function () {
                if (this.item.skus.length > 0) {
                    this.showSku = true;
                } else {
                    this.addToCart(this.item.itemid, 1);
                }
            },
            handleBuyNow: function () {
                if (this.item.skus.length > 0) {
                    this.showSku = true;
                } else {
                    this.showBuynow = true;
                }

            },
            onAddToCart(d){
                this.addToCart(this.item.itemid, d.quantity,d.sku.id);
            },
            addToCart(itemid, quantity, sku_id = 0) {
                this.$post('/webapi/cart/create', {itemid, quantity, sku_id}).then(response => {
                    this.$toast.success('已加入购物车');
                });
            },
            onBuyNow(d){
                this.quantity = d.quantity;
                this.sku = d.sku;
                this.showBuynow = true;
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
