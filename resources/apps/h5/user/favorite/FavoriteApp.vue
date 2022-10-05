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
    import PostCollect from "./PostCollect";
    import VideoCollect from "./VideoCollect";
    import ProductCollect from "./ProductCollect";

    export default {
        name: "FavoriteApp",
        components: {
            ProductCollect,
            PostCollect,
            VideoCollect
        }
    }
</script>

<style scoped>

</style>
