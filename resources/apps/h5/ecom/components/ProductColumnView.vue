<template>
    <div class="product-columns">
        <ul>
            <li v-for="(product,index) in productList" :key="index">
                <div class="inner">
                    <div class="pic-box">
                        <router-link :to="product.m_url">
                            <img :src="product.thumb" class="pic" alt="">
                        </router-link>
                    </div>
                    <div class="ctx-box">
                        <div class="title">
                            <router-link :to="product.m_url">
                                {{product.title}}
                            </router-link>
                        </div>
                        <div class="flex-row align-items-center">
                            <div class="price">￥{{product.price}}</div>
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
        name: "ProductColumnView",
        props: {
            productList: {
                type: Array,
                default() {
                    return []
                }
            }
        }
    }
</script>

<style lang="scss">

</style>
