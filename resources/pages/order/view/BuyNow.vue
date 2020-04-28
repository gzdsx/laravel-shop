<template>
    <div>
        <div class="area">
            <div class="order-address">
                <h3 class="confirm-address">
                    <a class="manage-address" href="/user/#/address" target="_blank">管理收货地址</a>
                    <span>确认收货地址</span>
                </h3>
                <ul class="address-list" id="address-list">
                    <li v-for="address in addresses">
                        <a class="edit-address" @click="handleEditAddress(address)">修改本地址</a>
                        <input title="" type="radio" :value="address.address_id" v-model="address_id">
                        <span>{{ address.full_address }}  ({{ address.name }} 收) {{ address.tel }}</span>
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
                        <th width="125">小计</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="item-info">
                                <img :src="item.thumb" class="thumb" alt="">
                                <div class="more-info">
                                    <div class="item-title">{{item.title}}</div>
                                    <div class="item-attr">{{sku.title}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="align-center">{{sku.price}}</td>
                        <td class="align-center">
                            <div class="flex-row justify-content-center">
                                <div class="input-number">
                                    <span class="input-btn" @click="decrease()">-</span>
                                    <span><input class="input-text" title="" type="number" v-model="quantity"></span>
                                    <span class="input-btn" @click="increase()">+</span>
                                </div>
                            </div>
                        </td>
                        <td class="align-center">￥{{sku.price}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="order-extra">
                    <div class="order-extra-row">
                        <div class="col-label">给掌柜留言:</div>
                        <div class="col-input">
                            <textarea class="textarea" placeholder="选填:对本次交易的说明" v-model="remark"></textarea></div>
                        <div>合计: <span class="total-fee">{{ totalFee }}</span>元</div>
                    </div>
                    <div class="order-extra-row">
                        <div class="col-label">运送方式:</div>
                        <div class="col-input">
                            <label><input type="radio" :value="1" v-model="shipping_type"> 快递</label>
                            <label><input type="radio" :value="2" v-model="shipping_type"> 物流配送</label>
                            <label><input type="radio" :value="3" v-model="shipping_type"> 上门自取</label>
                        </div>
                    </div>
                </div>
                <div class="order-btns">
                    <div class="flex"></div>
                    <button type="button" class="btn-submit" @click="submit()">提交订单</button>
                </div>
            </div>
        </div>
        <address-form :address="address" v-model="showAddressForm" @saved="handleSavedAddress"></address-form>
    </div>
</template>

<script>
    import AddressForm from "../../user/address/AddressForm";

    export default {
        name: "BuyNow",
        components: {
            AddressForm
        },
        data: function () {
            return {
                item,
                sku,
                addresses,
                quantity,
                pay_type,
                shipping_type,
                remark: '',
                address_id: 0,
                address: {},
                showAddressForm: true
            }
        },
        mounted() {
            this.addresses.map((ad) => {
                if (ad.isdefault) {
                    this.address_id = ad.address_id;
                }
            });
        },
        computed: {
            totalFee: function () {
                return (this.quantity * this.sku.price).toFixed(2);
            }
        },
        methods: {
            decrease: function () {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            },
            increase: function () {
                if (this.quantity < this.sku.stock) {
                    this.quantity++;
                }
            },
            submit: function () {
                if (!this.address_id) {
                    this.$showToast('请选择收货地址');
                    return false;
                }

                this.$post('/webapi/order/create', {
                    itemid: this.item.itemid,
                    sku_id: this.sku.id,
                    quantity: this.quantity,
                    shipping_type: this.shipping_type,
                    address_id: this.address_id
                }).then(response => {
                    if (response.data.errcode) {
                        this.$showToast(response.data.errmsg);
                    } else {
                        window.location.href = '/order/pay?order_id=' + response.data.order.order_id;
                    }
                });
            },
            handleAddAddress() {
                this.address = {};
                this.showAddressForm = true;
            },
            handleEditAddress(address) {
                this.address = address;
                this.showAddressForm = true;
            },
            handleSavedAddress(address) {
                if (this.address.address_id) {
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
