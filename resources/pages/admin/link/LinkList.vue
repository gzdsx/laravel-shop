<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>链接管理</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" v-model="tabIndex">
                        <el-tab-pane label="全部" name="all"></el-tab-pane>
                        <el-tab-pane
                                v-for="(catlog,index) in catlogs"
                                :label="catlog.title"
                                :name="catlog.id"
                                :key="index"
                        ></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="medium" @click="showDialog=true">添加链接</el-button>
                    </div>
                </div>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="aid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image class="w50 h50" fit="cover" :src="scope.row.image" @click="handlePickImage(scope.row)"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" label="网站名称">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="url" label="链接"></el-table-column>
                    <el-table-column label="编辑" width="60">
                        <template slot-scope="scope">
                            <el-link @click="handleEdit($event,scope.row)">编辑</el-link>
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
        <el-dialog :visible.sync="showDialog" width="35%" title="编辑链接">
            <el-form label-width="100px">
                <el-form-item label="网站名称">
                    <el-input v-model="link.title" size="medium" class="w300"></el-input>
                </el-form-item>
                <el-form-item label="网站链接">
                    <el-input v-model="link.url" size="medium" class="w300"></el-input>
                </el-form-item>
                <el-form-item label="显示顺序">
                    <el-input v-model="link.displayorder" size="medium" class="w300"></el-input>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button size="medium" @click="showDialog = false">取 消</el-button>
                <el-button size="medium" type="primary" @click="handleSubmit">确 定</el-button>
              </span>
        </el-dialog>
        <image-picker v-model="showPicker" @confirm="handleConfirmImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "LinkList",
        components: {
            AdminFrame,
            ImagePicker
        },
        data: function () {
            return {
                catid: 0,
                itemList: [],
                catlogs: [],
                selectionIds: [],
                tabIndex: 'all',
                showDialog: false,
                link: {},
                showPicker:false
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/link/batchget?type=item&catid=' + this.catid).then(response => {
                    this.itemList = response.data.items;
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/webapi/link/batchget?type=category').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选链接, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/webapi/link/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleTabClick: function (tab) {
                this.tabIndex = tab.name;
                this.fetchList();
            },
            handleEdit:function(e,link){
                this.link = link;
                this.showDialog = true;
            },
            handleSubmit: function () {
                if (!this.link.title) {
                    this.$showToast('请填写网站名称');
                    return false;
                }

                if (!this.link.url) {
                    this.$showToast('请填写网站链接');
                    return false;
                }

                this.$axios.post('/webapi/link/update', this.link).then(response => {
                    this.$showToast('链接保存成功');
                    this.showDialog = false;
                    this.fetchList();
                });
            },
            handlePickImage:function (link) {
                this.link = link;
                this.showPicker = true;
            },
            handleConfirmImage:function (data) {
                this.link.image = data.image;
                this.$axios.post('/webapi/link/update', this.link);
            }
        }
    }
</script>

<style scoped>

</style>
