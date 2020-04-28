<template>
    <el-dialog title="编辑地址" :visible.sync="visiable">
        <table class="dsxui-formtable">
            <colgroup>
                <col class="w90">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td class="cell-label">收货人</td>
                <td>
                    <el-input size="medium" class="w300" v-model="address.name"></el-input>
                </td>
            </tr>
            <tr>
                <td class="cell-label">联系电话</td>
                <td>
                    <el-input size="medium" class="w300" v-model="address.tel"></el-input>
                </td>
            </tr>
            <tr>
                <td class="cell-label">所在地</td>
                <td>
                    <el-cascader :props.sync="props" class="w300" v-model="cities" ref="cascader"></el-cascader>
                </td>
            </tr>
            <tr>
                <td class="cell-label">详细地址</td>
                <td>
                    <el-input size="medium" class="w400" v-model="address.street"></el-input>
                </td>
            </tr>
            <tr>
                <td class="cell-label">邮政编码</td>
                <td>
                    <el-input size="medium" class="w300" v-model="address.postalcode"></el-input>
                </td>
            </tr>
            <tr>
                <td class="cell-label"></td>
                <td>
                    <el-checkbox :true-label="1" :false-label="0" v-model="address.isdefault">设为默认地址</el-checkbox>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <el-button size="medium" type="primary" class="w200" @click="handleSave">保存</el-button>
                </td>
            </tr>
            </tbody>
        </table>
    </el-dialog>
</template>

<script>
    export default {
        name: "AddressForm",
        model: {
            prop: 'show',
            event: 'change'
        },
        props: {
            address: {
                address_id: 0
            },
            show: false
        },
        data: function () {
            return {
                props: {
                    lazy: true,
                    value: 'name',
                    label: 'name',
                    lazyLoad(node, resolve) {
                        const {level} = node;
                        const fid = node.data ? node.data.id : 0;
                        axios.get('/webapi/district/batchget?fid=' + fid).then(response => {
                            const items = response.data.items.map((o) => ({
                                ...o,
                                leaf: level >= 2
                            }));
                            resolve(items);
                        });
                    }
                },
                cities: [],
                visiable: false,
                cascader: null
            }
        },
        mounted() {

        },
        methods: {
            handleSave() {
                if (!this.address.name) {
                    this.$showToast('请填写姓名');
                    return false;
                }

                if (!this.address.tel) {
                    this.$showToast('请填写联系电话');
                    return false;
                }

                if (this.cities.length === 0) {
                    this.$showToast('请选择所在地区');
                    return false;
                } else {
                    this.address.province = this.cities[0];
                    this.address.city = this.cities[1];
                    this.address.district = this.cities[2];
                }

                if (!this.address.street) {
                    this.$showToast('请填写详细地址');
                    return false;
                }

                this.showDialog = false;
                this.$post('/user/address/update', {
                    address_id: this.address.address_id || 0,
                    address: this.address
                }).then(response => {
                    this.$showToast('地址保存成功');
                    this.visiable = false;
                    this.$emit('saved', response.data.address);
                });
            },
            setSascaderValue() {
                let cascader = this.$refs.cascader;
                if (cascader) {
                    cascader.panel.activePath = [];
                    cascader.panel.loadCount = 0;
                    cascader.panel.lazyLoad();
                }
            }
        },
        watch: {
            visiable(val) {
                this.$emit('change', val);
            },
            show(val) {
                this.visiable = val;
            },
            address(val) {
                const address = this.address;
                if (address.province) {
                    this.cities = [
                        address.province,
                        address.city,
                        address.district
                    ];
                }
                this.$nextTick(this.setSascaderValue);
            }
        }
    }
</script>

<style scoped>

</style>
