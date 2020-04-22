<template>
    <div class="sku">
        <div class="sku-item">
            <img :src="item.thumb" class="sku-item-thumb">
            <div class="sku-item-info">
                <div class="price">￥{{sku.price}}</div>
                <p>剩余{{sku.stock-quantity}}件</p>
                <p>已选择:{{sku.title}}</p>
            </div>
        </div>
        <div class="sku-attrs">
            <div class="sku-attrs-content">
                <div class="sku-attr-group" v-for="(attr,index) in item.attr_list" :key="index">
                    <div class="attr-title">{{attr.attr_title}}</div>
                    <div class="attr-values">
                        <div class="attr-values-item"
                             v-for="(val,i) in attr.attr_values"
                             :key="i"
                             :class="{'active':val.checked}"
                             @click="handleCheckSku(attr,i)"
                        >
                            {{val.attr_value}}
                        </div>
                    </div>
                </div>
                <div class="sku-attr-group display-flex">
                    <div class="flex">购买数量</div>
                    <van-stepper
                            v-model="quantity"
                            :default-value="quantity"
                            @change="handleQuantityChange(item)"
                            :max="sku.stock"
                    />
                </div>
            </div>
        </div>
        <div class="sku-button-group">
            <button class="v-btn v-btn-cart" @click="handleAddToCart">加入购物车</button>
            <button class="v-btn v-btn-buy" @click="handleBuyNow">立即购买</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SkuView",
        props: {
            item: {},
            skus: {}
        },
        data: function () {
            return {
                sku: {},
                props: {},
                quantity: 1
            }
        },
        mounted() {
            this.sku = {
                price: item.price,
                stock: item.stock
            };
            this.item.skus.map((sku) => {
                this.props[sku.properties] = sku;
            });
        },
        watch: {},
        methods: {
            handleCheckSku(attr, index) {
                attr.attr_values.forEach((val, i) => {
                    val.checked = index === i;
                });
                this.getSku();
                this.$forceUpdate();
            },
            getSku() {
                var props = [];
                this.item.attr_list.map((attr) => {
                    attr.attr_values.map((v) => {
                        if (v.checked) props.push(v.attr_id);
                    });
                });
                if (props.length > 0) {
                    var key = props.join('-');
                    if (this.props[key]) {
                        this.sku = this.props[key];
                    }
                }
            },
            handleAddToCart() {
                if (!this.sku.id){
                    this.$toast.fail('请选择产品型号');
                    return false;
                }
                this.$emit('addcart',{sku:this.sku,quantity:this.quantity});
            },
            handleBuyNow() {
                if (!this.sku.id){
                    this.$toast.fail('请选择产品型号');
                    return false;
                }
                this.$emit('buynow',{sku:this.sku,quantity:this.quantity});
            }
        }
    }
</script>

<style scoped>

</style>
