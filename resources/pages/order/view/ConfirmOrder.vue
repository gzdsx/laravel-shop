<template>
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
                    <th width="100">数量</th>
                    <th width="100">小计</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items" :key="index">
                    <td>
                        <div class="item-info">
                            <img :src="item.thumb" class="thumb" alt="">
                            <div class="more-info">
                                <div class="item-title">{{item.title}}</div>
                                <div class="item-attr">{{item.sku_title}}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{item.price}}</td>
                    <td>{{item.quantity}}</td>
                    <td>￥{{simpleTotal(item)}}</td>
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
        <address-form v-model="showDialog" :address="address" @saved="handleSavedAddress"></address-form>
    </div>
</template>

<script>
    import AddressForm from "../../user/address/AddressForm";

    export default {
        name: "ConfirmOrder",
        components: {
            AddressForm
        },
        data: function () {
            return {
                items,
                addresses,
                remark: '',
                address_id: 0,
                address: {},
                shipping_type: 1,
                showDialog: false
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
                return this.items.reduce((a, b) => a + b.quantity * b.price, 0).toFixed(2);
            }
        },
        methods: {
            decrease: function (item) {
                if (item.quantity > 1) {
                    item.quantity--;
                }
            },
            increase: function (item) {
                item.quantity++;
            },
            submit: function () {
                if (!this.address_id) {
                    this.$toast.success('请选择收货地址');
                    return false;
                }

                var items = this.items.map((d) => d.itemid);
                this.$axios.post('/webapi/order/settlement', {
                    items,
                    remark: this.remark,
                    address_id: this.address_id,
                }).then(response => {
                    const order = response.data.order;
                    window.location.href = '/order/pay?order_id=' + order.order_id;
                });
            },
            handleAddAddress() {
                this.address = {};
                this.showDialog = true;
            },
            handleEditAddress(address) {
                this.address = address;
                this.showDialog = true;
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
            },
            simpleTotal(item) {
                return (item.price * item.quantity).toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
