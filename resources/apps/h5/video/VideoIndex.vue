<template>
    <div class="container" style="background-color: #fff;">
        <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
            <van-swipe-item v-for="(item,index) in images" :key="index">
                <img :src="item.image" class="swipe-image" alt=""/>
            </van-swipe-item>
        </van-swipe>
        <div class="h20"></div>
        <div class="video-list">
            <div class="video-list-item" v-for="(item,index) in items" :key="index">
                <a :href="item.m_url">
                    <div class="bg-cover video-thumb" :style="{'background-image':'url('+item.image+')'}"></div>
                    <div class="video-data">
                        <div class="video-title">{{item.title}}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoIndex",
        data() {
            return {
                images: [],
                items: []
            }
        },
        mounted() {
            this.$get('/block/item/batchget?block_id=6').then(response => {
                this.images = response.result.items;
            });

            this.$get('/video/batchget').then(response => {
                this.items = response.result.items;
            });
        }
    }
</script>

<style scoped>

</style>
