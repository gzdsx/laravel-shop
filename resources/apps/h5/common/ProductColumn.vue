<template>
    <div class="product-column">
        <ul>
            <li v-for="product in products" :key="product.itemid">
                <div class="inner">

                    <div class="pic-box">
                        <router-link :to="'/product/detail?itemid='+product.itemid">
                            <img :src="product.thumb" class="pic" alt="">
                        </router-link>
                    </div>
                    <div class="ctx-box">
                        <div class="title">
                            <router-link :to="'/product/detail?itemid='+product.itemid">
                                {{product.title}}
                            </router-link>
                        </div>
                        <div class="reward">
                            <span>奖励</span>
                        </div>
                        <div class="flex-row align-items-center">
                            <div class="price">{{product.price}}</div>
                            <div class="flex-column justify-content-center">
                                <span class="iconfont icon-present"></span>
                            </div>
                            <div class="flex-fill"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ProductColumn",
        props: {
            products: []
        }
    }
</script>

<style lang="scss">

</style>
