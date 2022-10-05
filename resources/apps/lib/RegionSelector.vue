<template>
    <el-dialog title="选择区域" :visible="show" @close="onClose">
        <el-cascader-panel :props="props" @active-item-change="onExpand" @change="onChange"></el-cascader-panel>
        <div class="flex-row justify-content-end" style="margin-top: 20px;">
            <el-button size="medium" @click="onCancel">取消</el-button>
            <el-button size="medium" type="primary" @click="onConfirm">确定</el-button>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        name: "RegionSelector",
        props: {
            visible: {
                type: Boolean,
                default: false
            }
        },
        data() {
            let self = this;
            return {
                props: {
                    lazy: true,
                    value: 'name',
                    label: 'name',
                    lazyLoad(node, resolve) {
                        console.log(node);
                        const {level} = node;
                        const fid = node.root ? 0 : node.data.id;
                        self.$get('/district/list', {fid}).then(response => {
                            const items = response.result.items.map((o) => ({
                                ...o,
                                leaf: level >= 2
                            }));
                            resolve(items);
                        });
                    }
                },
                values: [],
                show: this.visible
            }
        },
        watch: {
            visible(val) {
                this.show = val;
            }
        },
        mounted() {
        },
        methods: {
            onChange(v) {
                console.log(v);
                this.values = v;
            },
            onCancel(e) {
                this.show = false;
                this.$emit('cancel');
            },
            onConfirm(e) {
                this.show = false;
                this.$emit('confirm', this.values);
            },
            onClose(e) {
                this.$emit('update:visible', false);
            },
            onExpand(e) {
                console.log(e);
                this.values = e;
            }
        }
    }
</script>

<style scoped>

</style>
