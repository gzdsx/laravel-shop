<template>
    <div>
        <div class="area">
            <div class="order-address">
                <h3 class="confirm-address">
                    <a class="manage-address" href="/user/#/address" target="_blank">管理收货地址</a>
                    <span>确认收货地址</span>
                </h3>
                <ul class="address-list" id="address-list">
                    <li v-for="addr in addresses">
                        <a class="edit-address" @click="handleEditAddress(addr)">修改本地址</a>
                        <input title="" type="radio" :value="addr" v-model="address">
                        <span>{{ addr.full_address }}  ({{ addr.name }} 收) {{ addr.tel }}</span>
                    </li>
                </ul>
                <div class="use-new-address">
                    <a class="button" @click="handleAddAddress()">+使用新地址</a>
                </div>
            </div>
            <div class="blank"></div>
            <div class="container">
                <h3>确认订单信息</h3>
                <table class="order-table">
                    <thead>
                    <tr>
                        <th class="align-left">宝贝</th>
                        <th width="125">单价</th>
                        <th width="160">数量</th>
                        <th width="100">小计</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="item-info">
                                <img :src="product.thumb" class="thumb" alt="">
                                <div class="more-info">
                                    <div class="item-title">{{product.title}}</div>
                                    <div class="item-attr">{{sku.title}}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{sku.price}}</td>
                        <td>
                            <div class="flex-row">
                                <div class="input-number">
                                    <span class="input-btn" @click="decrease">-</span>
                                    <span><input class="input-text" title="" type="number" v-model="quantity"></span>
                                    <span class="input-btn" @click="increase">+</span>
                                </div>
                            </div>
                        </td>
                        <td>￥{{product_fee}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="order-extra">
                    <div class="order-extra-row">
                        <div class="col-label">给掌柜留言:</div>
                        <div class="col-input">
                            <textarea class="textarea" placeholder="选填:对本次交易的说明" v-model="remark"></textarea></div>
                        <div>合计: <span class="total-fee">{{ order_fee }}</span>元</div>
                    </div>
                    <div class="order-extra-row">
                        <div class="col-label">运送方式:</div>
                        <div class="col-input">
                            <label><input type="radio" :value="1" v-model="shipping_type"> 快递</label>
                            <label><input type="radio" :value="2" v-model="shipping_type"> 上门自取</label>
                        </div>
                    </div>
                </div>
                <div class="order-btns">
                    <div class="flex"></div>
                    <button type="button" class="btn-submit" @click="submit">提交订单</button>
                </div>
            </div>
        </div>
        <address-form ref="address" v-model="showDialog" :address="newaddress"
                      @saved="handleSavedAddress"></address-form>
    </div>
</template>

<script>
    import AddressForm from "../../user/address/AddressForm";

    export default {
        name: "BuyNow",
        components: {
            AddressForm
        },
        data() {
            const {quantity, pay_type, shipping_type} = pageConfig;
            return {
                remark: '',
                address: {},
                newaddress: {},
                showDialog: false,
                addresses: [],
                product: {},
                sku: {},
                product_fee: 0,
                shipping_fee: 0,
                discount_fee: 0,
                order_fee: 0,
                quantity,
                pay_type,
                shipping_type,
            }
        },
        mounted() {
            this.$get('/address/get').then(response => {
                this.address = response.result.address;
            });

            this.$get('/address/batchget').then(response => {
                this.addresses = response.result.items;
            });

            this.fetchData();
        },
        methods: {
            fetchData() {
                const quantity = this.quantity;
                const {itemid, sku_id} = pageConfig;
                this.$post('/order/buynow', {itemid, sku_id, quantity}).then(response => {
                    const {product, sku, product_fee, shipping_fee, discount_fee, order_fee} = response.result.result;
                    this.sku = sku;
                    this.product = product;
                    this.product_fee = product_fee;
                    this.shipping_fee = shipping_fee;
                    this.discount_fee = discount_fee;
                    this.order_fee = order_fee;
                });
            },
            decrease() {
                if (this.quantity > 1) {
                    this.quantity--;
                    this.fetchData();
                }
            },
            increase() {
                if (this.quantity < this.sku.stock) {
                    this.quantity++;
                    this.fetchData();
                }
            },
            submit() {
                if (!this.address) {
                    this.$showToast('请选择收货地址');
                    return false;
                }

                const address = this.address;
                const quantity = this.quantity;
                const {itemid, sku_id, pay_type, shipping_type} = pageConfig;
                this.$post('/order/create', {
                    itemid,
                    sku_id,
                    quantity,
                    pay_type,
                    shipping_type,
                    address
                }).then(response => {
                    var url = '/order/pay?order_id=' + response.result.order.order_id;
                    if (window.location.replace) {
                        window.location.replace(url);
                    } else {
                        window.location.href = url;
                    }
                }).catch(reason => {
                    this.$showToast(response.result.errmsg);
                });
            },
            handleAddAddress() {
                this.newaddress = {};
                this.showDialog = true;
            },
            handleEditAddress(addr) {
                this.newaddress = addr;
                this.showDialog = true;
            },
            handleSavedAddress(address) {
                this.showDialog = false;
                if (address.address_id) {
                    this.addresses.map((addr, i) => {
                        if (addr.address_id === address.address_id) {
                            this.addresses.splice(i, 1, address);
                        }
                    });
                } else {
                    this.addresses.push(address);
                }
            }
        }
    }
</script>

<style scoped>

</style>
