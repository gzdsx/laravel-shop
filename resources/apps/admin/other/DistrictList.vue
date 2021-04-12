<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>区位管理</el-breadcrumb-item>
                <el-breadcrumb-item>区域列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>区位列表</span>
                            <span v-if="fid>0">>{{current.name}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleLoadParents" v-if="fid>0">返回上一级
                            </el-button>
                            <el-button type="primary" size="small" @click="handleShowAdd">添加新项</el-button>
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
                            <col style="width: 50px;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>
                                <el-checkbox @change="handleCheckAll"></el-checkbox>
                            </th>
                            <th>名称</th>
                            <th>拼音</th>
                            <th>首字母</th>
                            <th>区域代码</th>
                            <th>经度</th>
                            <th>纬度</th>
                            <th>选项</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in items" :key="index">
                            <td>
                                <el-checkbox :label="item.id">{{''}}</el-checkbox>
                            </td>
                            <td><a @click="handleLoadChildren(item)">{{item.name}}</a></td>
                            <td>{{item.pinyin}}</td>
                            <td>{{item.letter}}</td>
                            <td>{{item.zone_code}}</td>
                            <td>{{item.lng}}</td>
                            <td>{{item.lat}}</td>
                            <td><a @click="handleShowEdit(item)">编辑</a></td>
                        </tr>
                        </tbody>
                    </table>
                </el-checkbox-group>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
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
                    <td class="cell-label">名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="district.name"></el-input>
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
                        <el-input size="medium" v-model="district.zone_code"></el-input>
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
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="handleSave">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "DistrictList",
        components: {
            AdminFrame
        },
        data() {
            return {
                items: [],
                fid: 0,
                current: {},
                district: {},
                showDialog: false,
                selectionIds: []
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/district/batchget?fid=' + this.fid).then(response => {
                    this.items = response.result.items;
                });
            },
            fetchData() {
                this.$get('/district/get?id=' + this.fid).then(response => {
                    this.current = response.result.district;
                });
            },
            handleLoadChildren(item) {
                this.fid = item.id;
                this.fetchData();
                this.fetchList();
            },
            handleLoadParents() {
                this.fid = this.current.fid;
                this.fetchData();
                this.fetchList();
            },
            handleShowEdit(district) {
                this.district = district;
                this.showDialog = true;
            },
            handleShowAdd() {
                this.district = {
                    fid: this.fid,
                    level: this.fid > 0 ? this.current.level + 1 : 1
                };
                this.showDialog = true;
            },
            handleSave() {
                if (!this.district.name) {
                    this.$showToast('请填写区位名称');
                    return false;
                }
                this.showDialog = false;
                this.$post('/district/save', {
                    id: this.district.id,
                    district: this.district,
                }).then(response => {
                    this.fetchList();
                    this.district = {};
                });
            },
            handleDelete() {
                var items = this.selectionIds;
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/district/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleCheckAll(v) {
                if (v) {
                    this.selectionIds = this.items.map((g) => g.id);
                } else {
                    this.selectionIds = [];
                }
            }
        }
    }
</script>

<style scoped>

</style>
