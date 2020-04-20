<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>文章管理</el-breadcrumb-item>
                    <el-breadcrumb-item>分类管理</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">分类列表</div>
                        <el-popover
                                placement="bottom-end"
                                width="300"
                                trigger="click"
                                v-model="showpoper"
                        >
                            <div class="el-row">
                                <el-input v-model="params.name"></el-input>
                            </div>
                            <div class="display-flex" style="justify-content: flex-end">
                                <el-button size="small" @click="showpoper=false">取消</el-button>
                                <el-button size="small" type="primary" @click="handleAddCatlog">确定</el-button>
                            </div>
                            <el-button slot="reference" type="primary" size="small">添加分类</el-button>
                        </el-popover>
                    </div>
                </header>
                <table class="dsxui-listtable">
                    <colgroup>
                        <col width="50"></col>
                        <col width="50"></col>
                        <col></col>
                        <col width="200"></col>
                        <col width="200"></col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>图标</th>
                        <th>名称</th>
                        <th>排序</th>
                        <th class="align-right">选项</th>
                    </tr>
                    </thead>
                </table>
                <template v-if="catlogs.length>0">
                    <div v-for="(catlog,idx1) in catlogs" :key="idx1">
                        <table class="dsxui-listtable">
                            <colgroup>
                                <col width="50"></col>
                                <col width="50"></col>
                                <col></col>
                                <col width="200"></col>
                                <col width="200"></col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>{{catlog.catid}}</td>
                                <td>
                                    <div @click="handleShowPicker(catlog)">
                                        <img :src="catlog.icon" class="img-30 img-cover" v-if="catlog.icon"/>
                                        <div class="img-placeholder img-30" v-else></div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-weight: 500;">{{catlog.name}}</span>
                                    <el-popover
                                            placement="top-start"
                                            width="300"
                                            trigger="click"
                                            v-model="catlog.showEdit"
                                    >
                                        <div class="el-row">
                                            <el-input v-model="params.name"></el-input>
                                        </div>
                                        <div class="display-flex" style="justify-content: flex-end">
                                            <el-button size="small" @click="catlog.showEdit=false">取消</el-button>
                                            <el-button size="small" type="primary" @click="handleSaveEdit(catlog)">确定
                                            </el-button>
                                        </div>
                                        <a class="el-icon-edit-outline font-16 edit-icon"
                                           @click="handleShowEdit(catlog)"
                                           slot="reference"></a>
                                    </el-popover>
                                </td>
                                <td>
                                    <span class="el-icon-top sort-icon" @click="handleUpgrade(catlog.catid)"></span>
                                    <span class="el-icon-bottom sort-icon"
                                          @click="handleDowngrade(catlog.catid)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleDelete(catlog.catid)">删除</a>
                                        <span>|</span>
                                        <el-popover
                                                placement="bottom-end"
                                                width="200"
                                                trigger="click"
                                                v-model="catlog.showMove"
                                        >
                                            <div>
                                                <p class="move-tips">请选择要移至的一级分类</p>
                                                <div
                                                        class="move-row"
                                                        v-for="(c,i) in catlogs"
                                                        @click="handleMoveCatlog(catlog,c.catid)"
                                                        v-if="c.catid!==catlog.catid"
                                                        :key="i"
                                                >{{c.name}}
                                                </div>
                                            </div>
                                            <a @click="catid=catlog.catid" slot="reference">移动</a>
                                        </el-popover>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-if="catlog.children && catlog.children.length>0">
                            <tr v-for="(child,idx2) in catlog.children" :key="idx2">
                                <td>{{child.catid}}</td>
                                <td>
                                    <div @click="handleShowPicker(child)">
                                        <img :src="child.icon" class="img-30 img-cover" v-if="child.icon"/>
                                        <div class="img-placeholder img-30" v-else></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-flex">
                                        <span class="child-item-icon"></span>
                                        <span>{{child.name}}</span>
                                        <el-popover
                                                placement="top-start"
                                                width="300"
                                                trigger="click"
                                                v-model="child.showEdit"
                                        >
                                            <div class="el-row">
                                                <el-input v-model="params.name"></el-input>
                                            </div>
                                            <div class="display-flex" style="justify-content: flex-end">
                                                <el-button size="small" @click="child.showEdit=false">取消</el-button>
                                                <el-button size="small" type="primary" @click="handleSaveEdit(child)">
                                                    确定
                                                </el-button>
                                            </div>
                                            <a class="el-icon-edit-outline font-16 edit-icon" @click="handleShowEdit(child)"
                                               slot="reference"></a>
                                        </el-popover>
                                    </div>
                                </td>
                                <td>
                                    <span class="el-icon-top sort-icon" @click="handleUpgrade(child.catid)"
                                          v-if="idx2>0"></span>
                                    <span class="el-icon-bottom sort-icon" @click="handleDowngrade(child.catid)"
                                          v-if="idx2<(catlog.children.length - 1)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleUptop(child.catid)">升为一级</a>
                                        <span>|</span>
                                        <a @click="handleDelete(child.catid)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="4">
                                    <el-popover
                                            placement="bottom-start"
                                            width="300"
                                            trigger="click"
                                            v-model="catlog.showpoper"
                                    >
                                        <div class="el-row">
                                            <el-input v-model="params.name"></el-input>
                                        </div>
                                        <div class="display-flex" style="justify-content: flex-end">
                                            <el-button size="small" @click="catlog.showpoper=false">取消</el-button>
                                            <el-button size="small" type="primary" @click="handleAddChild(catlog)">确定
                                            </el-button>
                                        </div>
                                        <el-button slot="reference" size="small" type="text">
                                            <span class="el-icon-plus"></span>
                                            <span>添加子分类</span>
                                        </el-button>
                                    </el-popover>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </template>
                <div class="el-table__empty-block" style="height: 100%; width: 1125px;" v-else>
                    <span class="el-table__empty-text">暂无数据</span>
                </div>
            </div>
        </div>
        <image-picker v-model="showPicker" @confirm="handlePickImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "PostCatlog",
        components: {
            AdminFrame,
            ImagePicker
        },
        data: function () {
            return {
                catid: 0,
                params: {},
                catlogs: [],
                showpoper: false,
                showPicker: false
            }
        },
        mounted() {
            this.fetchCatlogs();
        },
        watch: {
            showPicker: function (val) {
                if (!val) this.resetParams();
            }
        },
        methods: {
            fetchCatlogs: function () {
                this.$axios.get('/webapi/post/catlog/getall').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            updateCatlog: function (cb) {
                var data = {catlog: this.params};
                if (this.catid > 0) data.catid = this.catid;
                this.$axios.post('/webapi/post/catlog/update', data).then(response => {
                    if (cb) cb(response.data);
                });
            },
            handleAddCatlog: function () {
                if (!this.params.name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }
                this.catid = 0;
                this.updateCatlog(() => {
                    this.showpoper = false;
                    this.resetParams();
                    this.fetchCatlogs();
                });
            },
            handleAddChild: function (catlog) {
                if (!this.params.name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }
                this.catid = 0;
                this.params.fid = catlog.catid;
                catlog.showpopper = false;
                this.updateCatlog(() => {
                    this.resetParams();
                    this.fetchCatlogs();
                });
            },
            handleDelete: function (catid) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/webapi/post/catlog/delete', {catid}).then(response => {
                        this.fetchCatlogs();
                    });
                });
            },
            handleUpgrade: function (catid) {
                this.$axios.post('/webapi/post/catlog/upgrade', {catid}).then(response => {
                    this.fetchCatlogs();
                });
            },
            handleDowngrade: function (catid) {
                this.$axios.post('/webapi/post/catlog/downgrade', {catid}).then(response => {
                    this.fetchCatlogs();
                });
            },
            handleUptop: function (catid) {
                this.catid = catid;
                this.params = {fid: 0};
                this.updateCatlog(() => {
                    this.resetParams();
                    this.fetchCatlogs();
                });
            },
            handleShowEdit:function(catlog){
                this.catid = catlog.catid;
                this.params = catlog;
            },
            handleSaveEdit: function (catlog) {
                catlog.showEdit = false;
                this.updateCatlog(() => {
                    this.resetParams();
                });
            },
            handleMoveCatlog: function (catlog, fid) {
                catlog.showMove = false;
                this.catid = catlog.catid;
                this.params = {fid};
                this.updateCatlog(cb => {
                    this.resetParams();
                    this.fetchCatlogs();
                });
            },
            handlePickImage: function (data) {
                this.params.icon = data.image;
                this.updateCatlog(() => {
                    this.resetParams();
                });
            },
            handleShowPicker: function (catlog) {
                this.catid = catlog.catid;
                this.params = catlog;
                this.showPicker = true;
            },
            resetParams: function () {
                this.catid = 0;
                this.params = {};
            }
        }
    }
</script>

<style lang="scss" scoped>
    .sort-icon {
        color: #409EFF;
        font-size: 16px;
        font-weight: bolder;
        margin: 2px 0;
        cursor: pointer;
    }

    .edit-icon {
        margin-left: 5px;
        line-height: 1;
        caret-color: #888;
    }

    .move-row {
        display: block;
        line-height: 32px;
        padding: 0 10px;
        cursor: pointer;

        &:hover {
            background-color: #f2f2f2;
        }
    }

    .move-tips {
        color: #999;
        font-size: 12px;
        margin-bottom: 5px;
    }
</style>
