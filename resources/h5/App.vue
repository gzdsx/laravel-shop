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
    </div>
</template>

<script>
    import TabBar from './components/TabBar';
    import ItemGridView from './components/ItemGridView';
    import {Swipe, SwipeItem} from 'vant';

    Vue.use(Swipe);
    Vue.use(SwipeItem);

    export default {
        name: "App",
        data: function () {
            return {
                images: [],
                items: [],
                chaozhi: []
            }
        },
        mounted() {
            var $this = this;
            this.$axios.get('/h5/block/item/batchget?block_id=1').then(function (response) {
                $this.images = response.data.items;
            });

            this.$axios.get('/h5/item/batchget').then(function (response) {
                $this.items = response.data.items;
            });
        },
        components: {
            'tab-bar': TabBar,
            'item-grid-view': ItemGridView
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

    .new-products{
        font-size: 22px;
        text-align: center;
        padding: 15px;
        display: block;
        font-weight: 500;
    }
</style>
