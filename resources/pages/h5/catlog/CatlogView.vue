<template>
    <div class="container">
        <van-tabs v-model="active" sticky>
            <van-tab v-for="(catlog,index) in catlogs" :title="catlog.name" :key="index"/>
        </van-tabs>
        <div class="goods-list-view">
            <div class="goods-list-item" v-for="item in items" :key="item.itemid">
                <a :href="item.h5_url">
                    <div class="display-flex">
                        <div class="bg-cover goods-image" :style="'background-image: url('+item.thumb+');'"></div>
                        <div class="goods-data">
                            <div class="title">{{item.title}}</div>
                            <div class="flex"></div>
                            <div class="display-flex">
                                <div class="price flex">￥{{item.price}}</div>
                                <span class="sold">已售{{item.sold}}件</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <tab-bar active-index="1"/>
    </div>
</template>

<script>
    import TabBar from "../components/TabBar";

    export default {
        name: "CatlogView",
        components: {
            'tab-bar': TabBar
        },
        data: function () {
            return {
                active: 0,
                catlogs: [],
                items: []
            }
        },
        mounted() {
            this.fetchCatlogs();
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/item/batchget').then(response => {
                    this.items = response.data.items;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/webapi/item/catlog/getall').then(response => {
                    this.catlogs = response.data.items;
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
