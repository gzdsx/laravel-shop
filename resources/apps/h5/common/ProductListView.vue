<template>
    <div class="item-list-view">
        <div class="items">
            <div class="item" v-for="item in items" :key="item.itemid">
                <a :href="item.m_url">
                    <div class="inner">
                        <div class="pic-box">
                            <img :src="item.thumb" class="pic" alt="">
                        </div>
                        <div class="ctx-box">
                            <div class="title">{{item.title}}</div>
                            <div class="flex"></div>
                            <div class="flex-row align-items-center">
                                <div class="price">￥{{item.price}}</div>
                                <span class="sold">已售{{item.sold}}件</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductListView",
        props:{
            items:[]
        }
    }
</script>

<style scoped>

</style>
