<template>
    <van-action-sheet
            v-model="show"
            :actions="actions"
            @select="onSelect"
            @close="onClose"
            cancel-text="取消"
            :round="false"
            get-container="body"
    />
</template>

<script>
    export default {
        name: "CancelOrder",
        data() {
            return {
                actions: []
            }
        },
        props: {
            show: false,
            order: {}
        },
        mounted() {
            this.$get('/order/closereason/getall').then(response => {
                this.actions = response.result.items.map(o => ({name: o}));
            });
        },
        methods: {
            onSelect(val) {
                this.show = false;
                this.$post('/bought/close', {
                    order_id: this.order.order_id,
                    reason: val.name
                }).then(response => {
                    this.$emit('didCancel', this.order);
                });
            },
            onClose() {
                this.$emit('update:show', false);
            }
        }
    }
</script>

<style scoped>

</style>
