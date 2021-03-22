<template>
    <div class="container">
        <div class="swipe-wrapper">
            <van-swipe class="item-swipe" :autoplay="3000" indicator-color="white">
                <van-swipe-item v-for="(img,index) in images" :key="index">
                    <div class="bg-cover swipe-image" :style="'background-image: url('+img.image+');'"></div>
                </van-swipe-item>
            </van-swipe>
        </div>

        <div class="goods-info">
            <div class="title">{{product.title}}</div>
            <div class="subtitle">{{product.subtitle}}</div>
            <div class="flex-row align-items-center" style="margin-top: 10px;">
                <div class="price flex">￥{{product.price}}</div>
                <div class="sold">已售{{product.sold}}件</div>
            </div>
        </div>

        <div class="goods-desc">
            <div class="title">商品详情</div>
            <div class="content" v-html="content.content"></div>
        </div>
        <div class="h50"></div>
        <van-goods-action>
            <van-goods-action-icon icon="chat-o" text="客服" @click="openKefu"/>
            <van-goods-action-icon icon="cart-o" text="购物车" @click="showCart"/>
            <van-goods-action-button type="warning" text="加入购物车" @click="handleAddToCart"/>
            <van-goods-action-button type="danger" text="立即购买" @click="handleBuyNow"/>
        </van-goods-action>

        <van-popup v-model="showSku" position="bottom">
            <sku-view :product="product" @submit="onSubmit"></sku-view>
        </van-popup>
        <form :action="'/h5/order/buynow'" ref="form">
            <input type="hidden" name="token" :value="$csrfToken">
            <input type="hidden" name="itemid" :value="product.itemid">
            <input type="hidden" name="sku_id" v-model="sku.sku_id">
            <input type="hidden" name="quantity" v-model="quantity">
        </form>
    </div>
</template>

<script>
    import SkuView from "./SkuView";

    export default {
        name: "ProductDetail",
        components: {
            SkuView
        },
        data() {
            return {
                product: {},
                images: [],
                content: {},
                sku: {},
                quantity: 1,
                showSku: false,
                actionType: 1
            }
        },
        mounted() {
            const itemid = pageConfig.itemid;
            this.$get('/product/get', {itemid}).then(response => {
                const {product} = response.data;
                const {images, content} = product;
                this.product = product;
                this.images = images;
                this.content = content;
            });
        },
        methods: {
            handleAddToCart() {
                if (this.product.skus.length > 0) {
                    this.showSku = true;
                    this.actionType = 1;
                } else {
                    this.addToCart(this.product.itemid, 1);
                }
            },
            handleBuyNow() {
                if (this.product.skus.length > 0) {
                    this.showSku = true;
                    this.actionType = 2;
                } else {
                    this.submitForm();
                }
            },
            addToCart(itemid, quantity, sku_id = 0) {
                this.$post('/cart/create', {itemid, quantity, sku_id}).then(response => {
                    this.$toast.success('已成功加入购物车');
                });
            },
            openKefu() {
                wx.closeWindow();
            },
            submitForm() {
                this.$refs.form.submit();
            },
            showCart() {
                window.location.replace('/h5/cart');
            },
            onSubmit(data) {
                //console.log(data);
                const {itemid} = this.product;
                const {sku, quantity} = data;
                this.sku = sku;
                this.quantity = quantity;
                this.showSku = false;

                setTimeout(() => {
                    if (this.actionType === 1) {
                        this.addToCart(itemid, quantity, sku.sku_id);
                    } else {
                        this.submitForm();
                    }
                }, 300);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .swipe-wrapper {
        padding-top: 80%;
        position: relative;

        .item-swipe {
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
