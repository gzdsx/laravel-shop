<template>
    <van-popup v-model="show" position="bottom" @close="onClose">
        <map-view :location="location" @confirm="onConfirm"/>
    </van-popup>
</template>

<script>
    import MapView from "./MapView";

    export default {
        name: "MapPicker",
        components: {MapView},
        model: {
            prop: 'show',
            event: 'change'
        },
        props: {
            show: {
                type: Boolean,
                default: false
            },
            location: {
                type: Boolean,
                default() {
                    return {}
                }
            }
        },
        methods: {
            onClose() {
                this.$emit('change', false);
            },
            onConfirm(position) {
                this.$emit('confirm', position);
                this.onClose();
            }
        }
    }
</script>

<style scoped>

</style>
