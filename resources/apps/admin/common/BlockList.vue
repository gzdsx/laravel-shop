<template>
    <div>
        <header class="page-header">
            <div class="page-title">内容模块</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>模块列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd">添加模块</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="id" width="50" label="ID"/>
                    <el-table-column prop="name" width="200" label="模块名称"/>
                    <el-table-column prop="description" label="备注说明"/>
                    <el-table-column width="120" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/block/item/'+scope.row.id">管理项目
                            </router-link>
                            <a @click="onShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
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
                    <td class="cell-label">模块名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="block.name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">模块介绍</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="5" class="w-100" v-model="block.description"></el-input>
                    </td>
                    <td class="cell-tips">模块参数介绍等</td>
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
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "BlockList",
        mixins: [PaginationMixin],
        data() {
            return {
                block: {},
                showDialog: false,
                listApi: '/common/block.getList'
            }
        },
        methods: {
            resetData() {
                this.block = {};
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/block.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onSubmit() {
                let {block} = this;
                let {id} = block;
                if (!block.name) {
                    this.$showToast('请填写模块名称');
                    return false;
                }

                this.$post('/common/block.save', {id, block}).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.block = d;
                this.showDialog = true;
            },
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
