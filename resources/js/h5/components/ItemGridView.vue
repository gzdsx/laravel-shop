<template>
    <ul class="item-grid-list">
        <li v-for="item in items" :key="item.itemid">
            <div class="hd">
                <router-link :to="'/item/detail/'+item.itemid">
                    <div class="image bg-cover" :style="{'background-image' : 'url('+item.thumb+')'}"></div>
                    <div class="title">{{item.title}}</div>
                    <div class="data">
                        <strong>￥{{item.price}}</strong>
                        <span><s>市场价:{{item.price>0 ? item.price : item.price}}</s></span>
                    </div>
                </router-link>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "ItemGridView",
        props:{
            items:Array
        }
    }
</script>

<style lang="scss">
    .item-grid-list{
        padding: 5px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;

        li{
            width: 50%;
            margin-bottom: 10px;
            overflow: hidden;
            display: block;

            .hd{
                display: block;
                margin: 0 5px;
                background-color: #fff;
                border-radius: 2px;
            }

            .image{
                padding-top: 100%;
                display: block;
                border-radius: 2px;
            }

            .title{
                display: block;
                margin: 7px 0;
                font-size: 14px;
                font-weight: 300;
                line-height: 16px;
                height: 32px;
                overflow: hidden;
                padding: 0 5px;
            }

            .data{
                display: flex;
                padding: 5px;

                strong{
                    flex: 1;
                    font-size: 16px;
                    color: #FF0000;
                    font-weight: 500;
                    line-height: 1;
                }

                span{
                    font-size: 12px;
                    color: #888;
                    font-weight: 300;
                    line-height: 16px;
                }
            }
        }
    }
</style>
