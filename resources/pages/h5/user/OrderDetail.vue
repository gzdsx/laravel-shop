<template>
    <div class="container">
        <order-view :order="order"></order-view>
    </div>
</template>

<script>
    import OrderView from "../components/OrderView";
    import OrderEditBar from "../components/OrderEditBar";

    export default {
        name: "OrderDetail",
        components: {
            OrderView,
            OrderEditBar
        },
        data: function () {
            return {
                order_id: 0,
                order: []
            }
        },
        mounted() {
            const order_id = this.$route.params.order_id;
            if (order_id) {
                this.order_id = order_id;
                this.getOrder();
            }
        },
        methods: {
            getOrder: function () {
                this.$axios.get('/webapi/bought/get?order_id=' + this.order_id).then(response => {
                    this.order = response.data.order;
                });
            },
            onPay: function () {
                this.getOrder();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
