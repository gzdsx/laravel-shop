<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">素材管理</h2>
            <div>
                <el-button type="primary" size="small" @click="showMediaDialog=true">添加素材</el-button>
            </div>
        </div>

        <div class="page-section">
            <div class="form-inline">
                <div class="form-item">
                    <div class="form-item-label">素材名称</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" v-model="params.name"></el-input>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">用户ID</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" v-model="params.uid"></el-input>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">用户名称</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" v-model="params.nickname"></el-input>
                    </div>
                </div>
                <div class="form-item">
                    <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="table-edit-header">
                <el-tabs @tab-click="onClickTab" value="image">
                    <el-tab-pane
                            v-for="(v,k) in materialTypes"
                            :key="k"
                            :label="v"
                            :name="k"
                    ></el-tab-pane>
                </el-tabs>
            </div>

            <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column label="图片" width="70">
                    <template slot-scope="scope">
                        <el-image :src="scope.row.thumb" class="img-60" fit="cover"/>
                    </template>
                </el-table-column>
                <el-table-column label="素材名称">
                    <template slot-scope="scope">
                        <div class="post-column-title">{{ scope.row.name }}</div>
                        <div class="post-column-actions">
                            <a @click="onEdit(scope.row)">编辑</a>
                            <span>|</span>
                            <a @click="deleteRecords([scope.row.id])">永久删除</a>
                            <span>|</span>
                            <a v-clipboard:copy="scope.row.url" v-clipboard:success="onCopy">复制URL</a>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="user.nickname" width="200" label="所属用户"/>
                <el-table-column prop="formated_size" width="100" label="大小"/>
                <el-table-column prop="created_at" width="170" label="发布时间"/>
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
        <el-dialog title="编辑素材" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 400px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="material.name"/>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">描述</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="6" v-model="material.description"/>
                    </td>
                    <td class="cell-tips">100个字以内</td>
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
        <media-dialog v-model="showMediaDialog" :options="{}"/>
    </main-layout>
</template>

<script>
import PaginationMixin from "../mixins/PaginationMixin";

export default {
    name: "MaterialList",
    mixins: [PaginationMixin],
    data() {
        return {
            materialTypes: {
                "image": "图片",
                "video": "视频",
                "voice": "声音",
                "doc": "文档",
                "file": "其他"
            },
            params: {
                name: '',
                uid: '',
                nickname: '',
                type: 'image'
            },
            listApi: '/materials',
            material: {},
            showMediaDialog: false,
            showDialog: false
        }
    },
    methods: {
        deleteRecords(ids) {
            this.$confirm('此操作将永久删除所选素材, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/material/delete', {ids}).then(() => {
                    this.fetchList();
                });
            });
        },
        onDelete() {
            let ids = this.selectionIds.map((d) => d.id);
            this.deleteRecords(ids);
        },
        onClickTab(tab) {
            this.params.type = tab.name;
            this.onSearch();
        },
        onCopy() {
            this.$message.success('URL复制成功');
        },
        onEdit(m) {
            this.material = m;
            this.showDialog = true;
        },
        onSubmit() {
            let {id, name, description} = this.material;
            if (!name) {
                this.$message.error('请填写名称');
                return false;
            }

            this.$post('/material', {id, material: {name, description}}).then(() => {
                this.showDialog = false;
                this.$message.success('素材已更新');
            });
        }
    },
    mounted() {
        this.fetchList();
    },
}
</script>

<style scoped>

</style>
