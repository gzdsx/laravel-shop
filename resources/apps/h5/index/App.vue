<template>
    <div>
        <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
            <van-swipe-item v-for="(item,index) in images" :key="index">
                <img :src="item.image" class="swipe-image" alt=""/>
            </van-swipe-item>
        </van-swipe>
        <div class="global-nav">
            <dl class="nav-item">
                <a href="/h5/product/search?sort=time-desc">
                    <dt class="nav-icon">
                        <img src="/images/app/menu/xinpin.png">
                    </dt>
                    <dd class="nav-title">新品</dd>
                </a>
            </dl>
            <dl class="nav-item">
                <a href="/h5/product/search?sort=sale-desc">
                    <dt class="nav-icon">
                        <img src="/images/app/menu/hot.png">
                    </dt>
                    <dd class="nav-title">热卖</dd>
                </a>
            </dl>
            <dl class="nav-item">
                <a href="/h5/live">
                    <dt class="nav-icon">
                        <img src="/images/app/menu/live.png">
                    </dt>
                    <dd class="nav-title">直播</dd>
                </a>
            </dl>
            <dl class="nav-item">
                <a href="/h5/video">
                    <dt class="nav-icon">
                        <img src="/images/app/menu/video.png">
                    </dt>
                    <dd class="nav-title">视频</dd>
                </a>
            </dl>
        </div>
        <div class="home-banner">
            <img src="/images/app/mryx.jpg">
        </div>

        <product-grid-view :items="items"></product-grid-view>
        <tab-bar active-index="0"/>
<!--        <van-popup v-model="showRedpack">-->
<!--            <div class="redpack" @click="sendPack"></div>-->
<!--        </van-popup>-->
    </div>
</template>

<script>
    import TabBar from '../common/TabBar';
    import ProductGridView from '../common/ProductGridView';

    export default {
        name: "App",
        components: {
            TabBar,
            ProductGridView
        },
        data: function () {
            return {
                images: [],
                items: [],
                showRedpack: true
            }
        },
        mounted() {
            var $this = this;
            this.$get('/block/item/batchget?block_id=1').then(function (response) {
                $this.images = response.data.items;
            });

            this.$get('/product/batchget').then(function (response) {
                $this.items = response.data.items;
            });
        },
        methods: {

        }
    }
</script>

<style lang="scss">
    .new-products {
        font-size: 22px;
        text-align: center;
        padding: 15px;
        display: block;
        font-weight: 500;
    }

    .van-popup {
        background: none;
    }
</style>
