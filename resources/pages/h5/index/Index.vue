<template>
    <div>
        <van-swipe class="swipe" :autoplay="3000" indicator-color="white">
            <van-swipe-item v-for="(item,index) in images" :key="index">
                <img :src="item.image" class="swipe-image"/>
            </van-swipe-item>
        </van-swipe>
        <div class="new-products">新品上市</div>
        <item-grid-view :items="items"></item-grid-view>
        <tab-bar active-index="0"/>
<!--        <van-popup v-model="showRedpack">-->
<!--            <div class="redpack" @click="sendPack"></div>-->
<!--        </van-popup>-->
    </div>
</template>

<script>
    import TabBar from '../components/TabBar';
    import ItemGridView from '../components/ItemGridView';

    export default {
        name: "Index",
        data: function () {
            return {
                images: [],
                items: [],
                showRedpack: true
            }
        },
        mounted() {
            var $this = this;
            this.$axios.get('/webapi/block/item/batchget?block_id=1').then(function (response) {
                $this.images = response.data.items;
            });

            this.$axios.get('/webapi/item/batchget').then(function (response) {
                $this.items = response.data.items;
            });
        },
        components: {
            'tab-bar': TabBar,
            'item-grid-view': ItemGridView
        },
        methods: {
            sendPack: function () {
                this.$axios.get('/webapi/redpack/send').then(response => {
                    this.$toast.fail(response.data.result.return_msg);
                });
            }
        }
    }
</script>

<style lang="scss">
    .swipe {
        height: 200px;

        &-image {
            width: 100%;
            height: 100%;
        }
    }

    .new-products {
        font-size: 22px;
        text-align: center;
        padding: 15px;
        display: block;
        font-weight: 500;
    }

    .van-popup {
        background: none;
    }
</style>
