<template>
    <div style="height: 50px;">
        <van-tabbar v-model="active" fixed="true" z-index="999">
            <van-tabbar-item v-for="(item, index) in items">
                <span>{{item.text}}</span>
                <img
                        slot="icon"
                        slot-scope="props"
                        :src="active === index ? item.icon.active :item.icon.normal"
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
                active: 0,
                items:[
                    {
                        text:'首页',
                        icon: {
                            normal: '/images/mobile/tabbar/home.png',
                            active: '/images/mobile/tabbar/home-fill.png'
                        }
                    },
                    {
                        text:'分类',
                        icon: {
                            normal: '/images/mobile/tabbar/catlog.png',
                            active: '/images/mobile/tabbar/catlog-fill.png'
                        }
                    },
                    {
                        text:'产销信息',
                        icon: {
                            normal: '/images/mobile/tabbar/we.png',
                            active: '/images/mobile/tabbar/we-fill.png'
                        }
                    },
                    {
                        text:'购物车',
                        icon: {
                            normal: '/images/mobile/tabbar/cart.png',
                            active: '/images/mobile/tabbar/cart-fill.png'
                        }
                    },
                    {
                        text:'我的',
                        icon: {
                            normal: '/images/mobile/tabbar/my.png',
                            active: '/images/mobile/tabbar/my-fill.png'
                        }
                    },
                ]
            }
        }
    }
</script>

<style scoped>
    .van-tabbar-item__icon img{
        height: 22px;
    }
    .van-tabbar-item--active {
        color: #30C361;
    }
</style>
