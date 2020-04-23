<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>视频管理</el-breadcrumb-item>
                <el-breadcrumb-item>视频列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>视频列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加视频</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image class="w50 h50" fit="cover" :src="scope.row.image"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" width="200" label="视频标题"></el-table-column>
                    <el-table-column prop="link" label="视频链接"></el-table-column>
                    <el-table-column prop="content" label="视频介绍"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间" width="170"></el-table-column>
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
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">视频封面</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="video.image" fit="cover" class="w80 h80" v-if="video.image"></el-image>
                            <div class="w80 h80 img-placeholder" v-else></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">视频标题</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="video.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">视频链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="video.link"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">视频介绍</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="3" v-model="video.content"></el-input>
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
        <image-picker v-model="showPicker" @confirm="handleConfirmImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "Video",
        components: {
            AdminFrame,
            ImagePicker
        },
        data: function () {
            return {
                itemList: [],
                video: {},
                id: 0,
                showDialog: false,
                selectionIds: [],
                showPicker:false
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList: function () {
                this.$get('/admin/video/batchget').then(response => {
                    this.itemList = response.data.items;
                });
            },
            handleUpdate(cb) {
                this.$post('/admin/video/update', {
                    id: this.id,
                    video: this.video
                }).then(response => {
                    this.resetData();
                    if (cb) cb(response);
                });
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d)=>d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/admin/video/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.video.title) {
                    this.$showToast('请填写标题');
                    return false;
                }
                if (!this.video.link) {
                    this.$showToast('请填写链接');
                    return false;
                }
                this.showDialog = false;
                this.handleUpdate(() => {
                    this.resetData();
                    this.fetchList();
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.video = d;
                this.id = d.id;
                this.showDialog = true;
            },
            handleSelectionChange(val){
                this.selectionIds = val;
            },
            handlePickImage:function (o) {
                this.video = o;
                this.showPicker = true;
            },
            handleConfirmImage:function (data) {
                this.video.image = data.image;
            },
            resetData() {
                this.id = '';
                this.video = {};
            }
        }
    }
</script>

<style scoped>

</style>
