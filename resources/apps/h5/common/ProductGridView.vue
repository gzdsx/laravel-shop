<template>
    <div class="item-grid-view">
        <ul>
            <li v-for="item in items" :key="item.itemid">
                <div class="inner">
                    <a :href="item.m_url">
                        <div class="pic-box">
                            <img :src="item.thumb" class="pic" alt="">
                        </div>
                        <div class="ctx-box">
                            <div class="title">{{item.title}}</div>
                            <div class="flex-row align-items-center">
                                <div class="price">￥{{item.price}}</div>
                                <div class="sold">已售{{item.sold}}件</div>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ProductGridView",
        props: {
            items: []
        }
    }
</script>

<style lang="scss">

</style>
