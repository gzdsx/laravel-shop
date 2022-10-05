<template>
    <div class="sku">
        <div class="sku-item">
            <img :src="product.thumb" class="sku-item-thumb" alt="">
            <div class="sku-item-info">
                <div class="price">￥{{sku.price}}</div>
                <p>剩余{{sku.stock}}件</p>
                <p>已选择:{{sku.title}}</p>
            </div>
        </div>
        <div class="sku-attrs">
            <div class="sku-attrs-content">
                <div class="sku-attr-group" v-for="(attr,i) in product.attrs" :key="i">
                    <div class="attr-title">{{attr.attr_title}}</div>
                    <div class="attr-values">
                        <div class="attr-values-item"
                             v-for="(val,j) in attr.attr_values"
                             :key="i"
                             :class="{'active':val.checked}"
                             @click="handleCheckSku(attr,j)"
                        >
                            {{val.attr_value}}
                        </div>
                    </div>
                </div>
                <div class="sku-attr-group display-flex">
                    <div class="flex">购买数量</div>
                    <van-stepper
                            v-model="quantity"
                            :max="sku.stock"
                            :min="1"
                    />
                </div>
            </div>
        </div>
        <div class="sku-button-group">
            <button class="v-btn" @click="handleSubmit">确定</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SkuView",
        props: {
            product: {}
        },
        data() {
            return {
                sku: {},
                skuList: {},
                skuProps: [],
                quantity: 1,
                selectedProps: {}
            }
        },
        mounted() {
            var {price, stock, skus} = this.product;
            this.sku = {price, stock};
            skus.map((sku) => {
                this.skuList[sku.properties] = sku;
            });
        },
        watch: {},
        methods: {
            handleCheckSku(attr, j) {
                attr.attr_values.forEach((val, i) => {
                    val.checked = j === i;
                });
                this.getSku();
                this.$forceUpdate();
            },
            getSku() {
                var props = [];
                this.product.attrs.map((attr) => {
                    attr.attr_values.map((v) => {
                        if (v.checked) props.push(v.attr_id);
                    });
                });
                if (props.length > 0) {
                    var key = props.join('-');
                    if (this.skuList[key]) {
                        this.sku = this.skuList[key];
                    }
                }
            },
            handleSubmit() {
                if (!this.sku.sku_id) {
                    this.$toast.fail('请选择产品型号');
                    return false;
                }
                this.$emit('submit', {sku: this.sku, quantity: this.quantity});
            },
        }
    }
</script>

<style scoped>

</style>
