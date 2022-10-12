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
                        <el-button @click="onShowAdd" type="primary" size="small">添加分类</el-button>
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
                <template v-if="dataList.length">
                    <div v-for="(cate,idx1) in dataList" :key="idx1">
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
                                <td>{{cate.cate_id}}</td>
                                <td>
                                    <img :src="cate.image" class="img-30 img-cover" v-if="cate.image"/>
                                    <div class="img-30 img-placeholder" v-else></div>
                                </td>
                                <td><span class="font-bold">{{cate.cate_name}}</span></td>
                                <td>
                                    <span class="el-icon-top sort-icon" @click="onIncrease(cate.cate_id)"></span>
                                    <span class="el-icon-bottom sort-icon" @click="onDecrease(cate.cate_id)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="onAddChild(cate.cate_id)">添加子分类</a>
                                        <span>|</span>
                                        <a @click="onShowEdit(cate)">编辑</a>
                                        <span>|</span>
                                        <a @click="onDelete(cate.cate_id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-if="cate.children && cate.children.length>0">
                            <tr v-for="(child,idx2) in cate.children" :key="idx2">
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
                                    <span class="el-icon-top sort-icon" @click="onIncrease(child.cate_id)"
                                          v-if="idx2>0"></span>
                                    <span class="el-icon-bottom sort-icon" @click="onDecrease(child.cate_id)"
                                          v-if="idx2<(cate.children.length - 1)"></span>
                                </td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="onUpgrade(child.cate_id)">升一级</a>
                                        <span>|</span>
                                        <a @click="onShowEdit(child)">编辑</a>
                                        <span>|</span>
                                        <a @click="onDelete(child.cate_id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </template>
                <div class="el-table__empty-block" style="height: 100%; width: 100%;" v-else>
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
                                    v-for="(cat,idx) in dataList"
                                    :label="cat.cate_name"
                                    :value="cat.cate_id"
                                    :key="idx"
                                    v-if="cat.cate_id!==category.cate_id"
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
        name: "ProductCategory",
        data() {
            return {
                category: {},
                dataList: [],
                showDialog: false,
                showPicker: false
            }
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product.category.getList').then(response => {
                    this.dataList = response.result.items;
                });
            },
            onSubmit() {
                const {category} = this;
                const {cate_id} = category;
                if (!category.cate_name) {
                    this.$showToast('请填写分类名称');
                    return false;
                }
                this.$post('/ecom/product.category.save', {
                    cate_id,
                    category
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    this.showDialog = false;
                });
            },
            resetData() {
                this.category = {cate_id: 0, parent_id: 0, sort_num: 0};
            },
            onAddChild(parent_id) {
                this.category = {
                    cate_id: 0,
                    parent_id
                };
                this.showDialog = true;
            },
            onDelete(cate_id) {
                this.$confirm('此操作将永久删除所选分类, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/product.category.delete', {cate_id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onUpgrade(cate_id) {
                this.$post('/ecom/product.category.upgrade', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            onIncrease(cate_id) {
                this.$post('/ecom/product.category.increase', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            onDecrease(cate_id) {
                this.$post('/ecom/product.category.decrease', {cate_id}).then(response => {
                    this.fetchList();
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.category = d;
                this.showDialog = true;
            },
            onChooseImage(data) {
                this.category.image = data.image;
            },
        },
        mounted() {
            this.resetData();
            this.fetchList();
        },
    }
</script>

<style lang="scss" scoped>

</style>
