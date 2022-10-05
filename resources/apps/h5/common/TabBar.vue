<template>
    <div class="safe-area-bottom-height">
        <van-tabbar v-model="active" :fixed="true" z-index="999" class="safe-area-padding-bottom">
            <van-tabbar-item v-for="(item, index) in items" :key="index" :to="item.to">
                <span :class="activeIndex === index ? 'van-tabbar-item--active' : ''">{{item.text}}</span>
                <img
                        slot="icon"
                        slot-scope="props"
                        :src="activeIndex === index ? item.icon.active :item.icon.normal"
                        alt=""
                >
            </van-tabbar-item>
        </van-tabbar>
    </div>
</template>

<script>
    export default {
        name: "TabBar",
        data() {
            return {
                items: [
                    {
                        text: '首页',
                        icon: {
                            normal: '/images/app/tabbar/home.png',
                            active: '/images/app/tabbar/home-fill.png'
                        },
                        to: '/'
                    },
                    {
                        text: '分类',
                        icon: {
                            normal: '/images/app/tabbar/catalog.png',
                            active: '/images/app/tabbar/catalog-fill.png'
                        },
                        to: '/product/category'
                    },
                    {
                        text: '平台介绍',
                        icon: {
                            normal: '/images/app/tabbar/tag.png',
                            active: '/images/app/tabbar/tag-fill.png'
                        },
                        to: '/page/index'
                    },
                    {
                        text: '购物车',
                        icon: {
                            normal: '/images/app/tabbar/cart.png',
                            active: '/images/app/tabbar/cart-fill.png'
                        },
                        to: '/cart'
                    },
                    {
                        text: '我的',
                        icon: {
                            normal: '/images/app/tabbar/my.png',
                            active: '/images/app/tabbar/my-fill.png'
                        },
                        to: '/home/index'
                    },
                ],
                active: 0
            }
        },
        props: {
            activeIndex: {
                type: Number,
                default: 0
            }
        },
        mounted() {
            this.active = this.activeIndex;
        }
    }
</script>

<style scoped>
    .van-tabbar-item__icon img {
        height: 22px;
    }
</style>
