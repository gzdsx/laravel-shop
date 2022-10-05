<template>
    <el-dialog
            :visible="visible"
            title="拖动地图选择位置"
            @close="onClose"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
    >
        <location-map-view @confirm="onConfirm"/>
    </el-dialog>
</template>

<script>
    import LocationMapView from "./LocationMapView";

    export default {
        name: "LocationPicker",
        components: {LocationMapView},
        model: {
            prop: 'visible',
            event: 'change'
        },
        props: {
            visible: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {}
        },
        methods: {
            onClose() {
                this.$emit('change', false);
            },
            onConfirm(position) {
                this.onClose();
                this.$emit('confirm', position);
            }
        },
        mounted() {
        }
    }
</script>

<style lang="scss" scoped>

</style>
