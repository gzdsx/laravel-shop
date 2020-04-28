<template>
    <div class="area cart">
        <div class="cart-main">
            <form method="post" ref="formCart" autocomplete="off" action="/order/confirm">
                <input type="hidden" name="_token" :value="token">
                <table class="cart-table">
                    <colgroup>
                        <col style="width: 40px;">
                        <col>
                        <col style="width: 100px;">
                        <col style="width: 140px;">
                        <col style="width: 100px;">
                        <col style="width: 100px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <label>
                                <input type="checkbox" v-model="checkedAll">
                            </label>
                        </th>
                        <th>商品信息</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>金额</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody v-if="itemList.length>0">
                    <tr v-for="(item,index) in itemList" :key="index">
                        <td class="item-info">
                            <label>
                                <input title=""
                                       type="checkbox"
                                       name="items[]"
                                       :value="item.itemid"
                                       v-model="item.checked"
                                       @change="handleChange(item,index)"
                                >
                            </label>
                        </td>
                        <td>
                            <div class="flex-row">
                                <div class="bg-cover item-thumb"
                                     :style="{'background-image': 'url('+item.thumb+')'}"></div>
                                <div class="flex">
                                    <div class="item-title"><a target="_blank">{{ item.title }}</a></div>
                                    <p class="item-sku">{{item.sku_title}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>￥{{ item.price }}</strong>
                        </td>
                        <td>
                            <div class="input-number">
                                <span class="input-btn" @click="decrease(item)">-</span>
                                <span class="flex">
                                    <input class="input-text" title="" type="number" v-model="item.quantity">
                                </span>
                                <span class="input-btn" @click="increase(item)">+</span>
                            </div>
                        </td>
                        <td><strong style="color: #f40;">￥{{computeTotal(item)}}</strong></td>
                        <td>
                            <p><a href="javascript:;">移入收藏夹</a></p>
                            <p><a href="javascript:;">删除</a></p>
                        </td>
                    </tr>
                    </tbody>
                    <tbody v-else>
                    <tr>
                        <td colspan="6">
                            <div class="noaccess"><a href="/">购物车空空也, 快去选购宝贝吧</a></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="cart-edit-footer">
            <div class="checkbox-wrapper">
                <input title="" type="checkbox" v-model="checkedAll">
                <span>全选</span>
            </div>
            <div class="operations">
                <a id="multiDelete">删除</a>
                <a id="moveToFavor">移入收藏夹</a>
            </div>
            <div class="settlement-buttons">
                <div class="item-sum">已选中<strong>{{ totalCount }}</strong>件商品</div>
                <div class="item-sum">合计 (不含运费): <strong>{{ totalFee }}</strong></div>
                <div class="btn-settlement" :class="{'btn-disabled':totalCount===0}" @click="settlement">结算</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CartApp",
        data: function () {
            return {
                itemList: [],
                totalFee: 0,
                totalCount: 0,
                checkedAll: false,
                token: ''
            }
        },
        mounted() {
            this.fetchList();
            this.token = document.head.querySelector('meta[name="csrf-token"]').content;
        },
        methods: {
            fetchList() {
                this.$get('/webapi/cart/getall').then(response => {
                    this.itemList = response.data.items;
                });
            },
            decrease: function (item) {
                if (item.quantity > 1) {
                    item.quantity--;
                    this.updateQuantity(item);
                }
            },
            increase: function (item) {
                item.quantity++;
                this.updateQuantity(item);
            },
            updateQuantity: function (item) {
                const {itemid, quantity} = item;
                this.$post('/webapi/cart/update', {itemid, quantity});
            },
            deleteItem: function (data, item) {

            },
            settlement: function () {
                if (this.totalCount > 0) {
                    this.$refs.formCart.submit();
                }
            },
            computeTotal(item) {
                return (item.price * item.quantity).toFixed(2);
            },
            handleChange(item) {
                var checked = this.itemList.filter((it) => !it.checked);
                this.checkedAll = checked.length === 0;
                this.computePrice();
            },
            computePrice() {
                this.totalFee = this.itemList.reduce((a, b) => {
                    if (b.checked) {
                        return a + b.price * b.quantity;
                    }
                    return a;
                }, 0).toFixed(2);

                this.totalCount = this.itemList.reduce((a, b) => {
                    if (b.checked) {
                        return a + b.quantity;
                    }
                    return a;
                }, 0);
            }
        },
        watch: {
            checkedAll(val) {
                this.itemList.forEach((it) => {
                    it.checked = val;
                });
                this.computePrice();
            }
        }
    }
</script>

<style scoped>

</style>
