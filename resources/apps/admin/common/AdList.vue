<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">广告管理</h2>
            <div>
                <el-button type="primary" size="small" @click="onShowAdd">添加广告</el-button>
            </div>
        </div>

        <section class="page-section">
            <el-table header-cell-class-name="table-header-cell" :data="dataList" v-loading="loading"
                      @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column prop="id" width="60" label="ID"/>
                <el-table-column prop="title" label="广告名称"/>
                <el-table-column prop="type_des" width="120" label="广告类型"/>
                <el-table-column prop="clicks" width="100" label="点击数" align="center"/>
                <el-table-column prop="state_des" width="100" label="状态" align="center"/>
                <el-table-column width="50" label="选项">
                    <template slot-scope="scope">
                        <a @click="onShowEdit(scope.row)">编辑</a>
                    </template>
                </el-table-column>
            </el-table>
            <div class="tablenav-bottom">
                <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                    批量删除
                </el-button>
                <el-button size="small" :disabled="selectionIds.length===0"
                           @click="onBatchUpdate({available:1})">
                    启用
                </el-button>
                <el-button size="small" :disabled="selectionIds.length===0"
                           @click="onBatchUpdate({available:0})">
                    停用
                </el-button>
            </div>
        </section>

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
                            <el-option label="文字广告" value="text"/>
                            <el-option label="图片广告" value="image"/>
                            <el-option label="代码广告" value="code"/>
                        </el-select>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='text'">
                <tr>
                    <td class="cell-label">广告文字</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.text"/>
                    </td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">广告链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.link"/>
                    </td>
                    <td class="tips"></td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='image'">
                <tr>
                    <td class="cell-label">图片</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="ad.data.image" fit="cover" class="w80 h80"/>
                        </div>
                    </td>
                    <td class="tips">上传新图片将会替换原有图片</td>
                </tr>
                <tr>
                    <td class="cell-label">宽度(可选)</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.width"/>
                    </td>
                    <td class="tips">图片显示宽度</td>
                </tr>
                <tr>
                    <td class="cell-label">高度(可选)</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.height"/>
                    </td>
                    <td class="tips">图片显示高度</td>
                </tr>
                <tr>
                    <td class="cell-label">链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="ad.data.link"/>
                    </td>
                    <td class="tips">图片链接</td>
                </tr>
                </tbody>
                <tbody v-if="ad.type==='code'">
                <tr>
                    <td class="cell-label">广告代码</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="5" v-model="ad.data.code"/>
                    </td>
                    <td class="tips">广告HTML代码</td>
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
        <media-dialog v-model="showPicker" @confirm="onChooseImage"/>
    </main-layout>
</template>

<script>

import PaginationMixin from "../mixins/PaginationMixin";

export default {
    name: "AdList",
    mixins: [PaginationMixin],
    data() {
        return {
            ad: {},
            showDialog: false,
            showPicker: false,
            listApi: '/ads'
        }
    },
    methods: {
        resetData() {
            this.ad = {
                id: 0,
                type: 'text',
                data: {}
            };
        },
        onDelete() {
            let ids = this.selectionIds.map((d) => d.id);
            this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/ad/delete', {ids}).then(() => {
                    this.fetchList();
                });
            });
        },
        onSubmit() {
            let {ad} = this;

            if (!ad.title) {
                this.$message.error('请填写名称');
                return false;
            }

            this.$post('/ad/save', {ad}).then(() => {
                this.resetData();
                this.fetchList();
                this.showDialog = false;
                this.$message.success('信息已保存');
            });
        },
        onShowAdd() {
            this.resetData();
            this.showDialog = true;
        },
        onShowEdit(d) {
            this.ad = d;
            if (this.ad.data === null) {
                this.ad.data = {};
            }
            this.showDialog = true;
        },
        onChooseImage(m) {
            this.ad.data.image = m.url;
        },
        onBatchUpdate(data) {
            let ids = this.selectionIds.map((d) => d.id);
            this.$post('/ad/batch_update', {ids, data}).then(() => {
                this.fetchList();
            });
        },
    },
    mounted() {
        this.resetData();
        this.fetchList();
    },
}
</script>

<style scoped>

</style>
