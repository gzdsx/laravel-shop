<template>
    <div class="content-block">
        <div class="console-title">
            <div class="float-right">
                <el-button type="primary" size="small" @click="handleShowAdd">添加收货地址</el-button>
            </div>
            <h2>收货地址管理</h2>
        </div>
        <section class="section">
            <table class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="120">联系人</th>
                    <th width="120">电话</th>
                    <th>地址</th>
                    <th width="80">邮编</th>
                    <th width="90">选项</th>
                    <th width="80"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items" :key="index">
                    <td height="50"><b>{{item.name}}</b></td>
                    <td>{{item.tel}}</td>
                    <td>{{item.formatted_address}}</td>
                    <td>{{item.postalcode}}</td>
                    <td>
                        <a @click="handleShowEdit(item)">修改</a>
                        <a @click="handleDelete(item.id)">删除</a>
                    </td>
                    <td>
                        <div v-if="item.isdefault" style="color: #f00;">默认地址</div>
                        <a v-else @click="handleSetDefault(item.id)">设为默认</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>

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
                        <el-cascader :props.sync="props" class="w300" v-model="cascaderValue" ref="cascader"></el-cascader>
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
        name: "Address",
        data() {
            var self = this;
            return {
                items: [],
                address: {},
                showDialog: false,
                props: {
                    lazy: true,
                    value: 'name',
                    label: 'name',
                    lazyLoad(node, resolve) {
                        const {level} = node;
                        const fid = node.data ? node.data.id : 0;
                        self.$get('/district/batchget?fid=' + fid).then(response => {
                            const items = response.result.items.map((o) => ({
                                ...o,
                                leaf: level >= 2
                            }));
                            resolve(items);
                        });
                    }
                },
                cascaderValue: [],
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/address/batchget').then(response => {
                    this.items = response.result.items;
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(address) {
                this.address = address;
                this.cascaderValue = [
                    address.province,
                    address.city,
                    address.district
                ];
                this.showDialog = true;
                setTimeout(this.$refs.cascader.panel.lazyLoad, 300);
            },
            handleSave() {
                this.saveData();
            },
            handleSetDefault(id) {
                this.$post('/address/setdefault', {id}).then(response => {
                    this.fetchList();
                });
            },
            handleDelete(id) {
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/address/delete', {id}).then(response => {
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
                this.$post('/address/save', {
                    id: this.address.id || 0,
                    address: this.address
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.$showToast('地址保存成功');
                });
            }
        }
    }
</script>

<style scoped>

</style>
