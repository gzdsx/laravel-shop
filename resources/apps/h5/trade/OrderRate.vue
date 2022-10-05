<template>
    <van-loading type="spinner" v-if="isLoading"/>
    <div class="container" v-else>
        <van-form @submit="onSubmit">
            <div v-for="(review,idx) in reviews" :key="idx">
                <div class="rate-item">
                    <div class="item-pic">
                        <img :src="order.items[idx].thumb" class="pic" alt="">
                    </div>
                    <div class="flex-fill">
                        <div class="item-title">{{order.items[idx].title}}</div>
                        <div class="item-sku">{{order.items[idx].sku_title}}</div>
                    </div>
                </div>
                <van-field label="商品评分">
                    <template #input>
                        <van-rate v-model="review.item_star"/>
                    </template>
                </van-field>
                <van-field label="服务评分">
                    <template #input>
                        <van-rate v-model="review.service_star"/>
                    </template>
                </van-field>
                <van-field label="物流评分">
                    <template #input>
                        <van-rate v-model="review.wuliu_star"/>
                    </template>
                </van-field>
                <van-field type="textarea" v-model="review.message" placeholder="对此次购物的评价"/>
                <van-cell>
                    <van-uploader
                            v-model="review.images"
                            :name="idx"
                            :max-count="3"
                            :max-size="3 * 1024 * 1024"
                            :multiple="true"
                    />
                    <p class="font-12">晒图片,最多3张</p>
                </van-cell>
            </div>
            <div style="padding: 20px; background-color: #fff;">
                <van-button round type="info" class="w-100">提交</van-button>
            </div>
        </van-form>
    </div>
</template>

<script>
    export default {
        name: "OrderRate",
        components: {},
        data() {
            return {
                order: {},
                reviews: [],
                isLoading: true,
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                const {order_id} = pageConfig;
                this.$get('/bought/get', {order_id}).then(response => {
                    this.order = response.result.order;
                    this.reviews = this.order.items.map(d => ({
                        item_star: 0,
                        service_star: 0,
                        wuliu_star: 0,
                        message: '',
                        order_id,
                        itemid: d.itemid,
                        images: []
                    }));
                    this.isLoading = false;
                });
            },
            async onSubmit() {
                const reviews = this.reviews;
                for (var k in reviews) {
                    var review = reviews[k];
                    var images = [];
                    for (var i = 0; i < review.images.length; i++) {
                        var imgFile = review.images[i];
                        if (imgFile.content) {
                            var formData = new FormData();
                            formData.append('file', imgFile.file, imgFile.file.name);
                            var response = await this.$axios.post('/material/uploadimg', formData, {
                                headers: {'Content-Type': 'multipart/form-data'}
                            });
                            const {thumb, image} = response.result.image;
                            images.push({
                                thumb,
                                image,
                                url: image
                            });
                        } else {
                            images.push(imgFile);
                        }
                    }
                    reviews[k].images = images;
                }


                const {order_id} = pageConfig;
                this.$post('/bought/rate', {reviews, order_id}).then(response => {
                    this.$toast.success('评价成功');
                    window.history.go(-1);
                });
            }
        }
    }
</script>

<style scoped>

</style>
