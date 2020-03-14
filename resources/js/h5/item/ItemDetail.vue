<template>
<div class="container">
    <van-swipe
            :autoplay="3000"
            indicator-color="red"
            height="320"
    >
        <van-swipe-item v-for="img in images" :key="img.id">
            <div class="swiper-bg-image bg-cover" :style="{'background-image':'url('+img.image+')'}"></div>
        </van-swipe-item>
    </van-swipe>
</div>
</template>

<script>
    export default {
        name: "ItemDetail",
        data: function () {
            return {
                images:[]
            }
        },
        mounted() {
            this.$axios.get('/h5/item/getitem?itemid='+this.$route.params.itemid).then(response=>{
                const {item,shop,images,content} = response.data;
                this.images = images;
            });
        }
    }
</script>

<style scoped>

</style>
