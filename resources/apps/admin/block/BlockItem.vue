<template>
    <div>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>内容模块</el-breadcrumb-item>
                <el-breadcrumb-item>项目管理</el-breadcrumb-item>
                <el-breadcrumb-item>项目列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>项目列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加项目</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column width="70" label="图片">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.image" class="w50 h50" fit="cover"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" width="200" label="标题"></el-table-column>
                    <el-table-column prop="url" label="链接"></el-table-column>
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
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 350px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">图片</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="item.image" fit="cover" class="w80 h80" v-if="item.image"></el-image>
                            <div class="w80 h80 img-placeholder" v-else></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">标题</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.url"></el-input>
                    </td>
                    <td class="cell-tips">目标链接</td>
                </tr>
                <tr>
                    <td class="cell-label">副标题</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.subtitle"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">附加字段1</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.field_1"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">附加字段2</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.field_2"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">附加字段3</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.field_3"></el-input>
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
        <image-picker :show.sync="showPicker" @confirm="handlePickImage"></image-picker>
    </div>
</template>

<script>
    export default {
        name: "BlockItem",
        data() {
            return {
                items: [],
                id: 0,
                item: {},
                block_id: 0,
                showDialog: false,
                selectionIds: [],
                showPicker: false
            }
        },
        mounted() {
            this.block_id = this.$route.query.block_id;
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/block/item/batchget?block_id=' + this.block_id).then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/block/item/save', {
                    id: this.id,
                    item: this.item
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.id = '';
                this.item = {};
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/block/item/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.item.image) {
                    this.$showToast('请选择图片');
                    return false;
                }
                if (!this.item.title) {
                    this.$showToast('请填写标题');
                    return false;
                }
                this.showDialog = false;
                this.saveData();
            },
            handleShowAdd() {
                this.resetData();
                this.item.block_id = this.block_id;
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.id = d.id;
                this.item = d;
                this.showDialog = true;
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handlePickImage(data) {
                this.item.image = data.image;
            },
        }
    }
</script>

<style scoped>

</style>
