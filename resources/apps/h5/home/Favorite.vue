<template>
    <van-tabs sticky>
        <van-tab title="产品">
            <product-collect/>
        </van-tab>
        <van-tab title="文章">
            <post-collect/>
        </van-tab>
        <van-tab title="视频">
            <video-collect/>
        </van-tab>
    </van-tabs>
</template>

<script>
    export default {
        name: "Favorite",
        components: {

        }
    }
</script>

<style scoped>

</style>
