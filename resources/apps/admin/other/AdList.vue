<template>
    <div>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>广告管理</el-breadcrumb-item>
                <el-breadcrumb-item>广告列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>广告列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">添加广告</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="id" width="60" label="ID"></el-table-column>
                    <el-table-column prop="title" label="广告名称"></el-table-column>
                    <el-table-column prop="type_des" width="120" label="广告类型"></el-table-column>
                    <el-table-column prop="clicks" width="100" label="点击数"></el-table-column>
                    <el-table-column prop="state_des" width="100" label="状态"></el-table-column>
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
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleBatchUpdate({available:1})">
                        启用
                    </el-button>
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleBatchUpdate({available:0})">
                        停用
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 350px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">广告名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.title"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">广告类型</td>
                    <td class="cell-input">
                        <el-select size="medium" class="w-100" v-model="ad.type">
                            <el-option label="文字广告" value="text"></el-option>
                            <el-option label="图片广告" value="image"></el-option>
                            <el-option label="代码广告" value="code"></el-option>
                        </el-select>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='text'">
                <tr>
                    <td class="cell-label">广告文字</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.text"></el-input>
                    </td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">广告链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.link"></el-input>
                    </td>
                    <td class="tips"></td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='image'">
                <tr>
                    <td class="cell-label">图片</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="ad.data.image" fit="cover" class="w80 h80"></el-image>
                        </div>
                    </td>
                    <td class="tips">上传新图片将会替换原有图片</td>
                </tr>
                <tr>
                    <td class="cell-label">宽度(可选)</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.width"></el-input>
                    </td>
                    <td class="tips">图片显示宽度</td>
                </tr>
                <tr>
                    <td class="cell-label">高度(可选)</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.height"></el-input>
                    </td>
                    <td class="tips">图片显示高度</td>
                </tr>
                <tr>
                    <td class="cell-label">链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.link"></el-input>
                    </td>
                    <td class="tips">图片链接</td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='code'">
                <tr>
                    <td class="cell-label">广告代码</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="5" v-model="ad.data.code"></el-input>
                    </td>
                    <td class="tips">广告HTML代码</td>
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
        <image-picker :show.sync="showPicker" @confirm="handleSelectImage"></image-picker>
    </div>
</template>

<script>
    export default {
        name: "AdList",
        data () {
            return {
                items: [],
                ad: {},
                id: '',
                showDialog: false,
                selectionIds: [],
                showPicker: false
            }
        },
        mounted() {
            this.fetchList();
            this.resetData();
        },
        methods: {
            fetchList () {
                this.$get('/ad/batchget').then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/ad/save', {
                    id: this.id,
                    ad: this.ad
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.id = '';
                this.ad = {
                    type: 'text',
                    data: {}
                };
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ad/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.ad.title) {
                    this.$showToast('请填写模块名称');
                    return false;
                }
                this.showDialog = false;
                this.saveData();
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(d) {
                this.id = d.id;
                this.ad = d;
                if (this.ad.data === null) {
                    this.ad.data = {};
                }
                this.showDialog = true;
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleSelectImage(data) {
                this.ad.data.image = data.image;
            },
            handleBatchUpdate(params){
                var items = this.selectionIds.map((d) => d.id);
                this.$post('/ad/batchupdate',{items,params}).then(response=>{
                    this.fetchList();
                });
            },
        }
    }
</script>

<style scoped>

</style>
