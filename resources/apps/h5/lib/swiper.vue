<template>
    <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
        <van-swipe-item v-for="(item,index) in items" :key="index">
            <img :src="item.image" class="swipe-image" alt=""/>
        </van-swipe-item>
    </van-swipe>
</template>

<script>
    export default {
        name: "swiper",
        props:{
            items:[]
        }
    }
</script>

<style scoped>

</style>
