<template>
    <van-action-sheet
            v-model="show"
            :actions="dataList"
            @select="onSelect"
            @close="onClose"
            cancel-text="取消"
            :round="false"
            get-container="body"
    />
</template>

<script>
    export default {
        name: "OrderCancelPannel",
        model: {
            prop: 'show',
            event: 'change'
        },
        props: {
            show: {
                type: Boolean,
                default: false
            },
            order: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        data() {
            return {
                dataList: []
            }
        },
        methods: {
            fetchList() {
                this.$get('/ecom/order.close.reasons').then(response => {
                    this.dataList = response.result.items.map((d) => ({name: d}));
                });
            },
            onSelect(val) {
                this.onClose();
                const reason = val.name;
                const {order_id} = this.order;
                this.$post('/trade/bought.cancel', {order_id, reason}).then(response => {
                    this.$emit('confirm', this.order);
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            },
            onClose() {
                this.$emit('change', false);
            }
        },
        mounted() {
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>
