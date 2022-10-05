<template>
    <div>
        <header class="page-header">
            <div class="page-title">商品分类</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex-fill">分类列表</div>
                        <el-button @click="showDialog=true" type="primary" size="small">添加分类</el-button>
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
                <template v-if="categories.length>0">
                    <div v-for="(cat,idx1) in categories" :key="idx1">
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
                                <td>{{cat.cate_id}}</td>
                                <td>
                                    <img :src="cat.image" class="img-30 img-cover" v-if="cat.image"/>
                                    <div class="img-30 img-placeholder" v-else></div>
                                </td>
                                <td><span class="font-bold">{{cat.cate_name}}</span></td>
                                <td>
                                    <span class="el-icon-top sort-icon" @click="handleIncrease(cat.cate_id)"></span>
                                    <span class="el-icon-bottom sort-icon" @click="handleDecrease(cat.cate_id)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleAddChild(cat.cate_id)">添加子分类</a>
                                        <span>|</span>
                                        <a @click="handleShowEdit(cat)">编辑</a>
                                        <span>|</span>
                                        <a @click="handleDelete(cat.cate_id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-if="cat.children && cat.children.length>0">
                            <tr v-for="(child,idx2) in cat.children" :key="idx2">
                                <td>{{child.cate_id}}</td>
                                <td>
                                    <img :src="child.image" class="img-30 img-cover" v-if="child.image"/>
                                    <div class="img-placeholder img-30" v-else></div>
                                </td>
                                <td>
                                    <div class="cell-flex">
                                        <span class="child-item-icon"></span>
                                        <span>{{child.cate_name}}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="el-icon-top sort-icon" @click="handleIncrease(child.cate_id)"
                                          v-if="idx2>0"></span>
                                    <span class="el-icon-bottom sort-icon" @click="handleDecrease(child.cate_id)"
                                          v-if="idx2<(cat.children.length - 1)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleUpgrade(child.cate_id)">升一级</a>
                                        <span>|</span>
                                        <a @click="handleShowEdit(child)">编辑</a>
                                        <span>|</span>
                                        <a @click="handleDelete(child.cate_id)">删除</a>
                                    </div>
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
        <el-dialog title="编辑信息"
                   closeable
                   :visible.sync="showDialog"
                   :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 350px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">分类图片</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="category.image" fit="cover" class="img-80" v-if="category.image"></el-image>
                            <div class="img-80 img-placeholder" v-else></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">分类名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.cate_name"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">上级分类</td>
                    <td class="cell-input">
                        <el-select class="w-100" v-model="category.parent_id">
                            <el-option :value="0" label="设为一级分类"></el-option>
                            <el-option
                                    v-for="(cat,idx) in categories"
                                    :label="cat.cate_name"
                                    :value="cat.cate_id"
                                    :key="idx"
                                    v-if="cat.cate_id!=category.cate_id"
                            />
                        </el-select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">分类标识</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.identifier"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">显示顺序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.sort_num"></el-input>
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
        <image-picker v-model="showPicker" @confirm="handlePickImage"></image-picker>
    </div>
</template>

<script>
    export default {
        name: "EcomCategory",
        data() {
            return {
                cate_id: 0,
                category: {},
                categories: [],
                showDialog: false,
                showPicker: false
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/ecom/category/list').then(response => {
                    this.categories = response.result.items;
                });
            },
            saveData(cb) {
                const {category} = this;
                const {cate_id} = category;
                if (!category.cate_name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }
                this.$post('/ecom/category/save', {
                    cate_id,
                    category
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                    if (cb) cb(response.result);
                });
            },
            resetData() {
                this.category = {cate_id: 0};
            },
            handleAddChild(parent_id) {
                this.category = {
                    cate_id: 0,
                    parent_id
                };
                this.showDialog = true;
            },
            handleDelete(cate_id) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/category/delete', {cate_id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleUpgrade(cate_id) {
                this.$post('/ecom/category/upgrade', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            handleIncrease(cate_id) {
                this.$post('/ecom/category/increase', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            handleDecrease(cate_id) {
                this.$post('/ecom/category/decrease', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            handleShowEdit(d) {
                this.category = d;
                this.showDialog = true;
            },
            handleSave() {
                this.saveData();
            },
            handlePickImage(data) {
                this.category.image = data.image;
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
