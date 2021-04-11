<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>菜单管理</el-breadcrumb-item>
                <el-breadcrumb-item>菜单详情</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>{{menu.title}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleShowAdd">新建菜单项</el-button>
                        </div>
                    </div>
                </header>
                <el-tree
                        :data="items"
                        :props="props"
                        @check="handleCheck"
                        node-key="id"
                        default-expand-all
                        :expand-on-click-node="false">
                    <div class="flex-row flex-fill" slot-scope="{ node, data }">
                        <div class="flex-fill">{{ node.label }}</div>
                        <div v-if="data.fid">
                            <a @click="handleShowEdit(data)">编辑</a>
                            <span>|</span>
                            <a @click="handleRemove(data)">删除</a>
                        </div>
                        <div v-else>
                            <a @click="handleShowAdd(data)">添加子菜单</a>
                            <span>|</span>
                            <a @click="handleShowEdit(data)">编辑</a>
                            <span>|</span>
                            <a @click="handleRemove(data)">删除</a>
                        </div>
                    </div>
                </el-tree>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable
                   :visible.sync="showDialog"
                   :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 400px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">菜单图片</td>
                    <td class="cell-input">
                        <div @click="showPicker=true">
                            <el-image :src="item.image" fit="cover" class="img-60" v-if="item.image"></el-image>
                            <div class="img-60 img-placeholder" v-else></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">菜单名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.title"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">菜单链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.url"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">显示顺序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="item.displayorder"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">上级菜单</td>
                    <td class="cell-input">
                        <el-select class="w-100" v-model="item.fid" @change="onFidChange">
                            <el-option label="设为一级菜单" :value="0"></el-option>
                            <el-option
                                    v-for="(it,idx) in items"
                                    :key="idx"
                                    :label="it.title"
                                    :value="it.id"
                                    v-if="item.id !== it.id"
                            ></el-option>
                        </el-select>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">打开方式</td>
                    <td class="cell-input">
                        <el-select class="w-100" v-model="item.target">
                            <el-option label="本窗口" value="_self"></el-option>
                            <el-option label="新窗口" value="_blank"></el-option>
                            <el-option label="顶层框架" value="_top"></el-option>
                        </el-select>
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
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "MenuItem",
        components: {
            AdminFrame,
        },
        data() {
            return {
                items: [],
                menu_id: 0,
                menu: {},
                id: 0,
                item: {
                    fid: 0
                },
                showDialog: false,
                showPicker: false,
                selectionIds: [],
                props: {
                    label: 'title'
                }
            }
        },
        mounted() {
            this.menu_id = this.$route.query.menu_id;
            this.fetchList();
            this.$get('/menu/get?menu_id=' + this.menu_id).then(response => {
                this.menu = response.result.menu;
            });
        },
        methods: {
            fetchList() {
                this.$get('/menu/item/batchget', {
                    menu_id: this.menu_id
                }).then(response => {
                    this.items = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/menu/item/save', {
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
                this.item = {
                    menu_id: this.menu_id
                };
            },
            handleSave() {
                if (!this.item.title) {
                    this.$showToast('请填写菜单名称');
                    return false;
                }
                if (!this.item.url){
                    this.$showToast('请填写菜单链接');
                    return false;
                }
                this.showDialog = false;
                this.saveData();
            },
            handleShowAdd(d) {
                this.resetData();
                this.showDialog = true;
                this.item.fid = d.id;
            },
            handleShowEdit(d) {
                this.id = d.id;
                this.item = d;
                this.showDialog = true;
            },
            handleRemove(d) {
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/menu/item/delete', {items: [d.id]}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onFidChange(val) {
                this.$forceUpdate();
            },
            handlePickImage(data) {
                this.item.image = data.image;
            },
        }
    }
</script>

<style scoped>

</style>
