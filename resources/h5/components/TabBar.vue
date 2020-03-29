<template>
    <div style="height: 50px;">
        <van-tabbar v-model="activeIndex" fixed="true" z-index="999">
            <van-tabbar-item v-for="(item, index) in items" :key="index" :url="item.url">
                <span :class="activeIndex == index ? 'van-tabbar-item--active' : ''">{{item.text}}</span>
                <img
                        slot="icon"
                        slot-scope="props"
                        :src="activeIndex == index ? item.icon.active :item.icon.normal"
                >
            </van-tabbar-item>
        </van-tabbar>
    </div>
</template>

<script>
    import {Tabbar, TabbarItem} from 'vant';

    Vue.use(Tabbar);
    Vue.use(TabbarItem);

    export default {
        name: "TabBar",
        data() {
            return {
                items: [
                    {
                        text: '首页',
                        icon: {
                            normal: '/images/h5/tabbar/home.png',
                            active: '/images/h5/tabbar/home-fill.png'
                        },
                        url: '/h5/'
                    },
                    {
                        text: '分类',
                        icon: {
                            normal: '/images/h5/tabbar/catlog.png',
                            active: '/images/h5/tabbar/catlog-fill.png'
                        },
                        url: '/h5/catlog/'
                    },
                    {
                        text: '购物车',
                        icon: {
                            normal: '/images/h5/tabbar/cart.png',
                            active: '/images/h5/tabbar/cart-fill.png'
                        },
                        url: '/h5/cart/'
                    },
                    {
                        text: '我的',
                        icon: {
                            normal: '/images/h5/tabbar/my.png',
                            active: '/images/h5/tabbar/my-fill.png'
                        },
                        url: '/h5/user/'
                    },
                ]
            }
        },
        props: {
            activeIndex: {
                default: 0,
                type: Number
            }
        }
    }
</script>

<style scoped>
    .van-tabbar-item__icon img {
        height: 22px;
    }

    .van-tabbar-item--active {
        color: #30C361;
    }
</style>
