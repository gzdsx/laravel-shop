<template>
    <div>
        <header class="page-header">
            <div class="page-title">区位管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>区位列表</span>
                            <span v-if="parent_id>0">>{{current.name}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onLoadParents" v-if="parent_id>0">返回上一级
                            </el-button>
                            <el-button type="primary" size="small" @click="onShowAdd">添加新项</el-button>
                        </div>
                    </div>
                </header>
                <el-checkbox-group v-model="selectionIds">
                    <table class="dsxui-listtable">
                        <colgroup>
                            <col style="width: 50px;">
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col style="width: 50px;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>
                                <el-checkbox @change="onCheckAll"></el-checkbox>
                            </th>
                            <th>ID</th>
                            <th>名称</th>
                            <th>全称</th>
                            <th>拼音</th>
                            <th>首字母</th>
                            <th>区域代码</th>
                            <th>经度</th>
                            <th>纬度</th>
                            <th>选项</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in dataList" :key="index">
                            <td>
                                <el-checkbox :label="item.id">{{''}}</el-checkbox>
                            </td>
                            <td>{{item.id}}</td>
                            <td><a @click="onLoadChildren(item)">{{item.name}}</a></td>
                            <td><a @click="onLoadChildren(item)">{{item.fullname}}</a></td>
                            <td>{{item.pinyin}}</td>
                            <td>{{item.letter}}</td>
                            <td>{{item.zonecode}}</td>
                            <td>{{item.lng}}</td>
                            <td>{{item.lat}}</td>
                            <td><a @click="onShowEdit(item)">编辑</a></td>
                        </tr>
                        </tbody>
                    </table>
                </el-checkbox-group>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">简称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">全称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.fullname"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">拼音</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.pinyin"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">首字母</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.letter"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">区位代码</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.zonecode"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">经度</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.lng"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">纬度</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.lat"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">区号</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.citycode"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">邮编</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.zipcode"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="onSubmit">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "DistrictList",
        data() {
            return {
                loading: true,
                dataList: [],
                parent_id: 0,
                current: {},
                district: {},
                showDialog: false,
                selectionIds: []
            }
        },
        methods: {
            fetchList() {
                let {parent_id} = this;
                this.loading = true;
                this.$get('/common/district.getList', {parent_id}).then(response => {
                    this.dataList = response.result.items;
                    this.loading = false;
                });
            },
            fetchData() {
                let {parent_id} = this;
                if (parent_id) {
                    this.$get('/common/district.getInfo', {id: parent_id}).then(response => {
                        this.current = response.result;
                    });
                }
            },
            onLoadChildren(item) {
                this.parent_id = item.id;
                this.fetchData();
                this.fetchList();
            },
            onLoadParents() {
                this.parent_id = this.current.parent_id;
                this.fetchData();
                this.fetchList();
            },
            onShowEdit(d) {
                this.district = d;
                this.showDialog = true;
            },
            onShowAdd() {
                this.district = {
                    parent_id: this.parent_id,
                    level: this.parent_id > 0 ? this.current.level + 1 : 1
                };
                this.showDialog = true;
            },
            onSubmit() {
                let {district} = this;
                if (!district.name) {
                    this.$showToast('请填写区位名称');
                    return false;
                }

                let {id} = district;
                this.$post('/common/district.save', {id, district}).then(() => {
                    this.fetchList();
                    this.district = {};
                    this.showDialog = false;
                });
            },
            onDelete() {
                let ids = this.selectionIds;
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/district.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onCheckAll(v) {
                if (v) {
                    this.selectionIds = this.items.map((g) => g.id);
                } else {
                    this.selectionIds = [];
                }
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
