<template>
    <div class="container">
        <van-swipe
                :autoplay="3000"
                indicator-color="red"
                height="200"
        >
            <van-swipe-item v-for="img in images" :key="img.id">
                <div class="swiper-bg-image bg-cover" :style="{'background-image':'url('+img.image+')'}"></div>
            </van-swipe-item>
        </van-swipe>

        <div class="global-menus">
            <ul class="wrapper">
                <li data-link="{{url('mobile/food')}}">
                    <div class="image"><img src="/images/mobile/menus/new.png"></div>
                    <div class="title">营养餐配送</div>
                </li>
                <li data-link="{{url('mobile/youxuan')}}">
                    <div class="image"><img src="/images/mobile/menus/youxuan.png"></div>
                    <div class="title">粗耕优选</div>
                </li>
                <li data-link="{{url('mobile/fupin')}}">
                    <div class="image"><img src="/images/mobile/menus/fupin.png"></div>
                    <div class="title">精准扶贫</div>
                </li>
                <li data-link="{{url('mobile/shop')}}">
                    <div class="image"><img src="/images/mobile/menus/pinpai.png"></div>
                    <div class="title">品牌计划</div>
                </li>
            </ul>
        </div>

        <div class="banner">
            <img src="/images/mobile/common/banner.png">
        </div>

        <div class="title-banner" style="background-image: url(/images/mobile/common/qianggou.png)"></div>
        <div style="background-color: #fff;">
            <van-swipe
                    :autoplay="3000"
                    :show-indicators="false"
            >
                <van-swipe-item v-for="(item, index) in chaozhi" :key="index">
                    <div class="chaozhi">
                        <div class="item" v-for="sub in item">
                            <div class="image bg-cover" :style="{'background-image':'url('+sub.thumb+')'}"></div>
                            <div class="title">{{sub.title}}</div>
                            <div class="price">￥{{sub.price}}</div>
                        </div>
                    </div>
                </van-swipe-item>
            </van-swipe>
        </div>
        <div class="title-banner" style="background-image: url(/images/mobile/common/tuijian.png)"></div>
        <div class="title-banner" style="background-image: url(/images/mobile/common/youxuan.png)"></div>
        <item-grid-view v-bind:items="items"></item-grid-view>
        <tab-bar></tab-bar>
    </div>
</template>

<script>
    import TabBar from './components/TabBar';
    import ItemGridView from './components/ItemGridView';
    export default {
        name: "App",
        data:function () {
            return {
                images:[],
                items:[],
                chaozhi:[]
            }
        },
        mounted() {
            var $this = this;
            this.$axios.get('/h5/block/getitems?block_id=13').then(function (response) {
                $this.images = response.data.items;
            });

            this.$axios.get('/h5/item/getitemlist').then(response=>{
                $this.items = response.data.items;
            });

            this.$axios.get('/h5/item/getitemlist?count=6').then(response=>{
                let chaozhi = [];
                let group = [];

                response.data.items.map((item, index) => {
                    group.push(item);
                    if ((index+1)%3 == 0)
                    {
                        chaozhi.push(group);
                        group = [];
                    }
                });

                if (group.length > 0 )
                {
                    chaozhi.push(group);
                }
                $this.chaozhi = chaozhi;
            });
        },
        components:{
            'tab-bar':TabBar,
            'item-grid-view':ItemGridView
        }
    }
</script>

<style lang="scss">

</style>
