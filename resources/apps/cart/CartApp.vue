<template>
    <div class="area cart">
        <div class="cart-title">
            <h1>购物车</h1>
        </div>
        <div class="cart-main">
            <form method="post" ref="formCart" autocomplete="off" action="/order/confirm">
                <input type="hidden" name="_token" :value="$csrfToken">
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
                    <tbody v-if="items.length>0">
                    <tr v-for="(item,index) in items" :key="index">
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
                                <div class="bg-cover product-thumb"
                                     :style="{'background-image': 'url('+item.thumb+')'}"></div>
                                <div class="flex">
                                    <div class="product-title">
                                        <a target="_blank">{{ item.title }}</a>
                                    </div>
                                    <p class="product-sku">{{item.sku_title}}</p>
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
                            <p><a @click="handleMoveToFavoritor(item)">移入收藏夹</a></p>
                            <p><a @click="handleDelete(item)">删除</a></p>
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
                <a @click="multiDelete">删除</a>
                <a @click="multiMove">移入收藏夹</a>
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
        data() {
            return {
                items: [],
                totalFee: 0,
                totalCount: 0,
                checkedAll: false,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/cart/getall').then(response => {
                    this.items = response.result.items;
                });
            },
            decrease(item) {
                if (item.quantity > 1) {
                    item.quantity--;
                    this.updateQuantity(item);
                }
            },
            increase(item) {
                item.quantity++;
                this.updateQuantity(item);
            },
            updateQuantity(item) {
                const {itemid, quantity} = item;
                this.$post('/cart/update', {itemid, quantity}).then(() => {
                    this.computePrice();
                });
            },
            settlement() {
                if (this.totalCount > 0) {
                    this.$refs.formCart.submit();
                }
            },
            computeTotal(item) {
                return (item.price * item.quantity).toFixed(2);
            },
            handleChange(item) {
                var checked = this.items.filter((it) => !it.checked);
                this.checkedAll = checked.length === 0;
                this.computePrice();
            },
            computePrice() {
                this.totalFee = this.items.reduce((a, b) => {
                    if (b.checked) {
                        return a + b.price * b.quantity;
                    }
                    return a;
                }, 0).toFixed(2);

                this.totalCount = this.items.reduce((a, b) => {
                    if (b.checked) {
                        return a + b.quantity;
                    }
                    return a;
                }, 0);
            },
            handleMoveToFavoritor(item) {
                this.$post('/cart/move', {items: [item.itemid]}).then(response => {
                    this.$showToast('已成功加入收藏夹');
                });
            },
            handleDelete(item) {
                if (confirm('确定要从购物车删除此宝贝吗?')) {
                    this.$post('/cart/delete', {items: [item.itemid]}).then(response => {
                        this.fetchList();
                    });
                }
            },
            multiDelete() {
                let items = [];
                this.items.map((d) => {
                    if (d.checked) items.push(d.itemid);
                });
                if (confirm('确定要将所选宝贝移入收藏夹吗?')) {
                    this.$post('/cart/move', {items}).then(response => {
                        this.fetchList();
                    });
                }
            },
            multiMove() {

            }
        },
        watch: {
            checkedAll(val) {
                this.items.forEach((it) => {
                    it.checked = val;
                });
                this.computePrice();
            }
        }
    }
</script>

<style scoped>

</style>
