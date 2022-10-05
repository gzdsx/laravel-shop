<template>
    <div class="container">
        <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
            <van-swipe-item v-for="(item,index) in images" :key="index">
                <img :src="item.image" class="swipe-image" alt=""/>
            </van-swipe-item>
        </van-swipe>
        <div class="live-list-view" v-if="items.length">
            <ul class="live-list">
                <li v-for="(item,index) in items" :key="index">
                    <a :href="item.m_url">
                        <div class="pic-box">
                            <img :src="item.image" alt="">
                        </div>
                        <div class="ctx-box">
                            <div class="title">{{item.title}}</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="live-noaccess" v-else>当前没有直播内容</div>
    </div>
</template>

<script>
    export default {
        name: "LiveIndex",
        components: {},
        data() {
            return {
                images: [],
                items: [],
            }
        },
        mounted() {
            this.$get('/block/item/batchget?block_id=4').then(response => {
                this.images = response.result.items;
            });

            this.$get('/live/batchget?state=1').then(response => {
                this.items = response.result.items;
            });
        },
        methods: {}
    }
</script>

<style scoped>

</style>
