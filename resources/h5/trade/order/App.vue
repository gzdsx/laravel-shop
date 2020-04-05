<template>
    <order-view :order="order"></order-view>
</template>

<script>
    import OrderView from "./OrderView";

    export default {
        name: "Order",
        components: {
            OrderView
        },
        data: function () {
            return {
                order
            }
        }
    }
</script>

<style scoped>

</style>
