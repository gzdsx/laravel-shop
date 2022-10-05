<template>
    <div>
        <header class="page-header">
            <div class="page-title">退货地址</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>地址列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加地址</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="name" width="200" label="收货人"></el-table-column>
                    <el-table-column prop="tel" width="200" label="联系电话"></el-table-column>
                    <el-table-column prop="formatted_address" label="收货地址"></el-table-column>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <a @click="handleShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog title="编辑地址" :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
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
                        <el-cascader :props.sync="props" class="w300" v-model="cities" ref="dsitrict"></el-cascader>
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
    </div>
</template>

<script>
    export default {
        name: "RefundAddress",
        data() {
            var that = this;
            return {
                items: [],
                id: 0,
                address: {},
                showDialog: false,
                selectionIds: [],
                props: {
                    lazy: true,
                    value: 'name',
                    label: 'name',
                    lazyLoad(node, resolve) {
                        const {level} = node;
                        const parent_id = node.data ? node.data.id : 0;
                        that.$get('/district/list', {parent_id}).then(response => {
                            const items = response.result.items.map((o) => ({
                                ...o,
                                leaf: level >= 2
                            }));
                            resolve(items);
                        });
                    }
                },
                cities: [],
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/ecom/refund/address/list').then(response => {
                    this.items = response.result.items;
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(address) {
                this.address = address;
                this.cities = [
                    address.province,
                    address.city,
                    address.district
                ];
                this.showDialog = true;
                setTimeout(this.setSascaderValue, 500);
            },
            handleSave() {
                this.saveData();
            },
            handleSetDefault(id) {
                this.$post('/ecom/refund/address/setdefault', {id}).then(response => {
                    this.fetchList();
                });
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/refund/address/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            resetData() {
                this.address = {};
            },
            saveData() {
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
                this.$post('/ecom/refund/address/save', {
                    id: this.address.id || 0,
                    address: this.address
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.$showToast('地址保存成功');
                });
            },
            setSascaderValue() {
                let cascader = this.$refs['dsitrict'];
                cascader.panel.activePath = [];
                cascader.panel.loadCount = 0;
                cascader.panel.lazyLoad();
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
        }
    }
</script>

<style scoped>

</style>
