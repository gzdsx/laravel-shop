<template>
    <div>
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
                        <el-button type="primary" size="small" @click="showDialog=true">添加链接</el-button>
                    </div>
                </div>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="aid" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image class="w50 h50" fit="cover" :src="scope.row.image"
                                      @click="handlePickImage(scope.row)"></el-image>
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
                            <a @click="handleEdit($event,scope.row)">编辑</a>
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
        <el-dialog :visible.sync="showDialog" width="35%" title="编辑链接" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w80">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>网站名称</td>
                    <td>
                        <el-input v-model="link.title" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>网站链接</td>
                    <td>
                        <el-input v-model="link.url" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>显示顺序</td>
                    <td>
                        <el-input v-model="link.displayorder" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button size="medium" type="primary" @click="handleSubmit" class="w100">确 定</el-button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
        <image-picker v-model="showPicker" @confirm="handleConfirmImage"></image-picker>
    </div>
</template>

<script>
    export default {
        name: "LinkList",
        data() {
            return {
                catid: 0,
                items: [],
                catlogs: [],
                selectionIds: [],
                tabIndex: 'all',
                showDialog: false,
                link: {},
                showPicker: false
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCatlogs();
        },
        methods: {
            fetchList() {
                this.$get('/link/batchget?type=item&catid=' + this.catid).then(response => {
                    this.items = response.result.items;
                });
            },
            fetchCatlogs() {
                this.$get('/link/batchget?type=category').then(response => {
                    this.catlogs = response.result.items;
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选链接, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/link/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleTabClick(tab) {
                this.tabIndex = tab.name;
                this.fetchList();
            },
            handleEdit(e, link) {
                this.link = link;
                this.showDialog = true;
            },
            handleSubmit() {
                if (!this.link.title) {
                    this.$showToast('请填写网站名称');
                    return false;
                }

                if (!this.link.url) {
                    this.$showToast('请填写网站链接');
                    return false;
                }

                this.$post('/link/save', {
                    id: this.link.id,
                    link: this.link
                }).then(response => {
                    this.$showToast('链接保存成功');
                    this.showDialog = false;
                    this.fetchList();
                });
            },
            handlePickImage(link) {
                this.link = link;
                this.showPicker = true;
            },
            handleConfirmImage(data) {
                this.link.image = data.image;
                this.$post('/link/save', {
                    id: this.link.id,
                    link: this.link
                }).then(response => {
                    this.fetchList();
                });
            }
        }
    }
</script>

<style scoped>

</style>
