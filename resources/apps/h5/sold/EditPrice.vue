<template>
    <van-form @submit="handleSubmit">
        <div>
            <van-cell>
                <div class="display-flex">
                    <div class="w60">商品</div>
                    <div class="flex">{{item.title}}</div>
                </div>
            </van-cell>
            <van-field
                    v-model="item.price"
                    name="price"
                    label="单价"
                    type="number"
                    label-width="60px"
                    :rules="[{ required: true }]"
            />
            <van-field
                    v-model="item.quantity"
                    name="quantity"
                    label="数量"
                    type="number"
                    label-width="60px"
                    :rules="[{ required: true }]"
            />
        </div>
        <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
                提交
            </van-button>
        </div>
    </van-form>
</template>

<script>
    export default {
        name: "EditPrice",
        data: function () {
            return {}
        },
        props: {
            item: Object
        },
        methods: {
            handleSubmit: function (c) {
                const {id, price, quantity} = this.item;
                this.$post('/sold/editprice', {id, price, quantity}).then(response => {
                    this.$emit('save', this.item);
                });
            }
        }
    }
</script>

<style scoped>

</style>
