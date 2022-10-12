<template>
    <div>
        <header class="page-header">
            <div class="page-title flex-fill">菜单详情</div>
            <div>
                <router-link to="/menu/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>{{menu.name}}</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="onShowAdd(0)">添加菜单项</el-button>
                        </div>
                    </div>
                </header>
                <table class="dsxui-listtable">
                    <colgroup>
                        <col width="50"></col>
                        <col width="150"></col>
                        <col></col>
                        <col width="100"></col>
                        <col width="100"></col>
                        <col width="200"></col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>图标</th>
                        <th>名称</th>
                        <th>链接</th>
                        <th>显示</th>
                        <th>排序</th>
                        <th class="align-right">选项</th>
                    </tr>
                    </thead>
                </table>
                <template v-if="dataList.length>0">
                    <div v-for="(item,idx1) in dataList" :key="idx1">
                        <table class="dsxui-listtable">
                            <colgroup>
                                <col width="50"></col>
                                <col width="150"></col>
                                <col></col>
                                <col width="100"></col>
                                <col width="100"></col>
                                <col width="200"></col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>
                                    <img :src="item.image" class="img-30" v-if="item.image"/>
                                    <div class="img-30 img-placeholder" v-else></div>
                                </td>
                                <td><span class="font-bold">{{item.title}}</span></td>
                                <td><span class="font-bold">{{item.url}}</span></td>
                                <td>
                                    <div @click="onToggle(item)">
                                        <i class="el-icon-close font-22" v-if="item.hide"></i>
                                        <i class="el-icon-check font-22" v-else></i>
                                    </div>
                                </td>
                                <td>{{item.sort_num}}</td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="onShowAdd(item.id)">添加子菜单</a>
                                        <span>|</span>
                                        <a @click="onShowEdit(item)">编辑</a>
                                        <span>|</span>
                                        <a @click="onDelete(item.id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-if="item.children && item.children.length">
                            <tr v-for="(child,idx2) in item.children" :key="idx2">
                                <td>
                                    <img :src="child.image" class="img-30" v-if="child.image"/>
                                    <div class="img-placeholder img-30" v-else></div>
                                </td>
                                <td>
                                    <div class="cell-flex">
                                        <span class="child-item-icon"></span>
                                        <span>{{child.title}}</span>
                                    </div>
                                </td>
                                <td>{{child.url}}</td>
                                <td>
                                    <div @click="onToggle(child)">
                                        <i class="el-icon-close font-22" v-if="child.hide"></i>
                                        <i class="el-icon-check font-22" v-else></i>
                                    </div>
                                </td>
                                <td>{{child.sort_num}}</td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="onShowEdit(child)">编辑</a>
                                        <span>|</span>
                                        <a @click="onDelete(child.id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </template>
                <div class="el-table__empty-block" v-else>
                    <span class="el-table__empty-text">暂无数据</span>
                </div>
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
                        <el-input size="medium" v-model="item.sort_num"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">上级菜单</td>
                    <td class="cell-input">
                        <el-select class="w-100" v-model="item.parent_id" @change="onFidChange">
                            <el-option label="设为一级菜单" :value="0"></el-option>
                            <el-option
                                    v-for="(it,idx) in dataList"
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
                <tr>
                    <td class="cell-label">隐藏菜单</td>
                    <td class="cell-input">
                        <el-radio-group v-model="item.hide">
                            <el-radio :label="1">是</el-radio>
                            <el-radio :label="0">否</el-radio>
                        </el-radio-group>
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
        name: "MenuItem",
        data() {
            return {
                menu: {},
                item: {},
                dataList: [],
                showDialog: false,
                showPicker: false,
                selectionIds: [],
                props: {
                    label: 'title'
                }
            }
        },
        methods: {
            fetchList() {
                let {menu_id} = this.$route.params;
                this.$get('/common/menu.item.getList', {menu_id}).then(response => {
                    let {menu, items} = response.result;
                    this.menu = menu;
                    this.dataList = items;
                });
            },
            resetData() {
                let {menu_id} = this.$route.params;
                this.item = {id: 0, parent_id: 0, hide: 0, menu_id};
            },
            onSubmit() {
                let {item} = this;
                let {id} = item;
                if (!item.title) {
                    this.$showToast('请填写菜单名称');
                    return false;
                }
                if (!item.url) {
                    this.$showToast('请填写菜单链接');
                    return false;
                }

                this.$post('/common/menu.item.save', {id, item}).then(() => {
                    this.showDialog = false;
                    this.resetData();
                    this.fetchList();
                });
            },
            onShowAdd(id) {
                this.resetData();
                this.item.parent_id = id;
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.item = d;
                this.showDialog = true;
            },
            onDelete(id) {
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/menu.item.batchDelete', {ids: [id]}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onFidChange(val) {
                this.$forceUpdate();
            },
            onChooseImage(data) {
                this.item.image = data.image;
            },
            onToggle(item) {
                let {id} = item;
                this.$post('/common/menu.item.toggle', {id}).then(() => {
                    item.hide = item.hide === 0 ? 1 : 0;
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
