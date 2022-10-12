<template>
    <div>
        <header class="page-header">
            <div class="page-title flex-fill">项目管理</div>
            <div>
                <router-link to="/block/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="table-edit-title flex-fill">
                            <span>{{block.name}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加项目</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="block.items" style="width: 100%" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column width="70" label="图片">
                        <template slot-scope="scope">
                            <el-image :src="scope.row.image" class="img-50" fit="cover"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" width="200" label="标题"/>
                    <el-table-column prop="url" label="链接"/>
                    <el-table-column prop="sort_num" label="排序" align="center" width="100"/>
                    <el-table-column width="50" label="选项">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
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
                <tr>
                    <td class="cell-label">排序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.sort_num"></el-input>
                    </td>
                    <td class="cell-tips">数字越大越靠前</td>
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
        <image-picker v-model="showPicker" @confirm="onChooseImage"/>
    </div>
</template>

<script>
    export default {
        name: "BlockItem",
        data() {
            return {
                item: {},
                block: {},
                selectionIds: [],
                showDialog: false,
                showPicker: false
            }
        },
        methods: {
            fetchData() {
                let {block_id} = this.$route.params;
                this.$get('/common/block.getInfo', {id: block_id}).then(response => {
                    this.block = response.result;
                }).catch(reason => {
                    this.$showToast(reason.errMsg);
                });
            },
            resetData() {
                let {block_id} = this.$route.params;
                this.item = {block_id, sort_num: 0};
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/block.item.batchDelete', {ids}).then(response => {
                        this.fetchData();
                    });
                });
            },
            onSubmit() {
                let {item} = this;
                if (!item.image) {
                    this.$showToast('请选择图片');
                    return false;
                }
                if (!item.title) {
                    this.$showToast('请填写标题');
                    return false;
                }

                let {id} = this.item;
                this.$post('/common/block.item.save', {id, item}).then(() => {
                    this.resetData();
                    this.fetchData();
                    this.showDialog = false;
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.item = d;
                this.showDialog = true;
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            },
            onChooseImage(data) {
                this.item.image = data.image;
            },
        },
        mounted() {
            this.fetchData();
        },
    }
</script>

<style scoped>

</style>
