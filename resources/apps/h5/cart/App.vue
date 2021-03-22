<template>
    <div class="container" style="padding-bottom: 50px;">
        <div class="cart" style="background-color: #fff;" v-if="itemList.length>0">
            <van-checkbox-group v-model="result" @change="handleChange" ref="checkboxGroup">
                <van-swipe-cell :right-width="65" v-for="(item,index) in itemList" :key="index">
                    <div class="cart-item">
                        <div class="checkbox-view">
                            <van-checkbox :name="item"/>
                        </div>
                        <div class="pic-box">
                            <img :src="item.thumb" class="pic" alt="">
                        </div>
                        <div class="ctx-box">
                            <div class="title">{{item.title}}</div>
                            <div class="sku-title" v-if="item.sku_id">{{item.sku_title}}</div>
                            <div class="flex"></div>
                            <div class="flex-row align-items-center">
                                <div class="price">￥{{item.price}}</div>
                                <div>
                                    <van-stepper
                                            v-model="item.quantity"
                                            :default-value="item.quantity"
                                            @change="handleQuantityChange(item)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="delete-cell" slot="right" @click="handleDelete(item.itemid)">删除</div>
                </van-swipe-cell>
            </van-checkbox-group>
        </div>
        <div class="cart-empty" v-else>
            <span class="iconfont icon-cart_light"></span>
            <p>购物车是空的</p>
        </div>
        <van-submit-bar
                :price="totalFee"
                button-text="结算"
                @submit="handleSubmit"
                style="bottom: 50px"
        >
            <van-checkbox v-model="checked" @click="handleCheckAll">全选</van-checkbox>
        </van-submit-bar>
        <tab-bar active-index="2"/>
        <form method="post" :action="'/h5/order/confirm'" ref="form">
            <input type="hidden" name="_token" :value="$csrfToken">
            <input type="hidden" name="items[]" v-for="(o,i) in result" :key="i" :value="o.itemid">
        </form>
    </div>
</template>

<script>
    import TabBar from "../common/TabBar";

    export default {
        name: "App",
        components: {
            TabBar
        },
        data: function () {
            return {
                itemList: [],
                result: [],
                checked: false,
                showConfirm: false,
                totalFee: 0,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/cart/getall').then(response => {
                    this.itemList = response.data.items;
                });
            },
            handleSubmit: function () {
                //console.log(this.result);
                if (this.result.length === 0) {
                    this.$toast.success('请选择结算商品');
                    return false;
                }
                this.$refs.form.submit();
            },
            handleChange: function (c) {
                this.checked = this.result.length === this.itemList.length;
                //console.log(this.result);
            },
            handleCheckAll: function () {
                if (this.checked) {
                    this.$refs.checkboxGroup.toggleAll(true);
                } else {
                    this.$refs.checkboxGroup.toggleAll(false);
                }
            },
            handleDelete: function (itemid) {
                this.$axios.post('/cart/delete', {items: [itemid]}).then(response => {
                    this.itemList = this.itemList.filter(function (d) {
                        return d.itemid !== itemid;
                    });
                });
            },
            handleQuantityChange: function (item) {
                const {itemid, quantity} = item;
                this.$axios.post('/cart/update', {itemid, quantity});
            }
        },
        watch: {
            result(val) {
                //var totalFee = val.reduce((a, b) => a + b.price * b.quantity, 0);
                this.totalFee = val.reduce((a, b) => a + b.price * b.quantity, 0).toFixed(2) * 100;
                //console.log(this.totalFee);
            }
        }
    }
</script>

<style scoped>

</style>
