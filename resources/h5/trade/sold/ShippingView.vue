<template>
    <div>
        <h3>发货信息</h3>
        <div class="order-data-cell">快递名称: {{shipping.express_name}}</div>
        <div class="order-data-cell">快递单号: {{shipping.express_no}}</div>
        <div class="order-data-cell">发货时间: {{shipping.shipping_at}}</div>
    </div>
</template>

<script>
    export default {
        name: "ShippingView",
        props:{
            shipping:Object
        }
    }
</script>

<style scoped>

</style>
