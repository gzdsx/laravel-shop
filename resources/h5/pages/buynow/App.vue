<template>
    <div class="container buynow">
        <div class="address">
            <div>
                <span>大师兄</span>
                <span>18685849696</span>
            </div>
            <p>贵州省平塘县中央大街11222号</p>
        </div>
        <div class="h10"></div>
        <div class="buynow-goods-info">
            <div class="title">商品信息</div>
            <div class="goods-item">
                <div class="bg-cover image" :style="'background-image: url('+item_DATA.thumb+')'"></div>
                <div class="data">
                    <div class="goods-title">{{item_DATA.title}}</div>
                    <div class="flex"></div>
                    <div class="display-flex">
                        <div class="goods-price">￥{{item_DATA.price}}</div>
                        <div>
                            <van-stepper
                                    default-value="1"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="buynow-cell">
                <div class="cell-title flex">配送方式</div>
                <div class="cell-value">快递</div>
            </div>
            <div class="buynow-cell">
                <div class="cell-title">留言</div>
                <div class="cell-value flex">
                    <input type="text" class="message" placeholder="建议留言前先与商家沟通确认">
                </div>
            </div>
        </div>
        <div class="h10"></div>
        <div class="settlement-info">
            <div class="buynow-cell">
                <div class="cell-title flex">商品金额</div>
                <div class="cell-value">￥100.00</div>
            </div>
            <div class="buynow-cell">
                <div class="cell-title flex">运费</div>
                <div class="cell-value amount">￥0.00</div>
            </div>
            <div class="buynow-cell">
                <div class="cell-title flex">合计</div>
                <div class="cell-value amount">￥100.00</div>
            </div>
        </div>
        <van-submit-bar
                :price="3050"
                button-text="提交订单"
                @submit="onSubmit"
        />
    </div>
</template>

<script>
    import {Stepper, Field, SubmitBar} from 'vant';

    Vue.use(Stepper);
    Vue.use(Field);
    Vue.use(SubmitBar);

    export default {
        name: "App",
        data: function () {
            return {
                item_DATA,
                address_DATA
            }
        }
    }
</script>

<style scoped>

</style>
