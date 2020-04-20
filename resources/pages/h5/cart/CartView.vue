<template>
    <div class="container" style="background-color: #fff; padding-bottom: 50px;">
        <div class="cart">
            <van-checkbox-group v-model="result" @change="onChange">
                <van-swipe-cell :right-width="65" v-for="item in itemList" :key="item.id">
                    <div class="cart-item">
                        <div class="checkbox-view">
                            <van-checkbox :name="item.itemid"/>
                        </div>
                        <div class="bg-cover image" :style="'background-image: url('+item.thumb+')'"></div>
                        <div class="data">
                            <div class="title">{{item.title}}</div>
                            <div class="flex"></div>
                            <div class="display-flex">
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
                    <div class="delete-cell" slot="right" @click="onDelete(item.itemid)">删除</div>
                </van-swipe-cell>
            </van-checkbox-group>
        </div>
        <van-submit-bar
                :price="totalFee"
                button-text="结算"
                @submit="onSubmit"
                style="bottom: 50px"
        >
            <van-checkbox v-model="checked" @change="onCheckAll">全选</van-checkbox>
        </van-submit-bar>
        <tab-bar active-index="2"/>
    </div>
</template>

<script>
    import TabBar from "../components/TabBar";

    export default {
        name: "CartView",
        components: {
            'tab-bar': TabBar
        },
        data: function () {
            return {
                itemList: [],
                result: [],
                checked: false
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/cart/getall').then(response => {
                    this.itemList = response.data.items;
                });
            },
            onSubmit: function () {
                //console.log(this.result);
                if (this.result.length === 0) {
                    this.$toast.success('请选择结算商品');
                    return false;
                }
                // this.$axios.post('/h5/auction/settlement',{items:this.result}).then(response=>{
                //     console.log(response.data);
                // });
                window.location.href = '/h5/order/confirm?items=' + this.result.join(',');
            },
            onChange: function () {
                if (this.result.length === this.itemList.length) {
                    this.checked = true;
                } else {
                    this.checked = false;
                }
            },
            onCheckAll: function () {
                if (this.checked) {
                    var result = [];
                    this.itemList.map((d, i) => {
                        result.push(d.itemid);
                    });
                    this.result = result;
                } else {
                    this.result = [];
                }
            },
            onDelete: function (itemid) {
                this.$axios.post('/webapi/cart/delete', {items: [itemid]}).then(response => {
                    this.itemList = this.itemList.filter(function (d) {
                        return d.itemid !== itemid;
                    });
                });
            },
            handleQuantityChange: function (item) {
                const {itemid, quantity} = item;
                this.$axios.post('/webapi/cart/update', {itemid, quantity});
            }
        },
        computed: {
            totalFee: function () {
                var total = 0;
                this.itemList.map((d, i) => {
                    if (_.indexOf(this.result, d.itemid) !== -1) {
                        total += d.price * d.quantity;
                    }
                });
                return parseInt(total * 100);
            }
        }
    }
</script>

<style scoped>

</style>
