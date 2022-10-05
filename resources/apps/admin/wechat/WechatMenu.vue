<template>
    <div>
        <header class="page-header">
            <div class="page-title">菜单管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>菜单列表</span>
                            <p class="font-12 font-normal">最多仅支持三个一级菜单，每个一级菜单最多仅支持5个二级菜单</p>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleAddMenu">添加菜单
                            </el-button>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleApplyMenu">应用菜单</el-button>
                        </div>
                    </div>
                </header>
                <table class="dsxui-listtable">
                    <colgroup>
                        <col>
                        <col width="300">
                        <col width="200">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>类型</th>
                        <th class="align-right">选项</th>
                    </tr>
                    </thead>
                </table>
                <template v-if="items.length>0">
                    <div v-for="(item,idx1) in items" :key="idx1">
                        <table class="dsxui-listtable">
                            <colgroup>
                                <col>
                                <col width="300">
                                <col width="200">
                            </colgroup>
                            <tbody>
                            <tr>
                                <td><span style="font-weight: 500;">{{item.name}}</span></td>
                                <td>{{item.type_des}}</td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleShowEdit(item)">编辑</a>
                                        <span>|</span>
                                        <a @click="handleDelete(item.id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-if="item.children && item.children.length>0">
                            <tr v-for="(child,idx2) in item.children" :key="idx2">
                                <td>
                                    <span class="child-item-icon"></span>
                                    <span>{{child.name}}</span>
                                </td>
                                <td>{{child.type_des}}</td>
                                <td class="align-right">
                                    <div class="action-links">
                                        <a @click="handleShowEdit(child)">编辑</a>
                                        <span>|</span>
                                        <a @click="handleDelete(child.id)">删除</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <el-button size="small" type="text" @click="handleAddChildren(item.id)">
                                        <span class="el-icon-plus"></span>
                                        <span>添加子分类</span>
                                    </el-button>
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
        <el-dialog title="编辑菜单" closeable :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">菜单名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.name"></el-input>
                    </td>
                    <td class="cell-tips">一级菜单不超过4个字，二级不超过7个字</td>
                </tr>
                <tr>
                    <td class="cell-label">响应类型</td>
                    <td class="cell-input">
                        <el-select size="medium" v-model="menu.type" class="w-100">
                            <el-option
                                    v-for="(type,key) in types"
                                    :label="type"
                                    :value="key"
                                    :key="key"
                            ></el-option>
                        </el-select>
                    </td>
                    <td class="cell-tips">点击菜单后所执行的操作</td>
                </tr>
                </tbody>
                <tbody v-if="menu.type==='view'">
                <tr>
                    <td class="cell-label">网页链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.url"></el-input>
                    </td>
                    <td class="cell-tips">用户点击菜单可打开链接，不超过1024字节</td>
                </tr>
                </tbody>
                <tbody v-else-if="menu.type==='media_id'">
                <tr>
                    <td class="cell-label">永久素材ID</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.media_id"></el-input>
                    </td>
                    <td class="cell-tips">填写永久素材的合法media_id</td>
                </tr>
                </tbody>
                <tbody v-else-if="menu.type==='miniprogram'">
                <tr>
                    <td class="cell-label">appId</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.appid"></el-input>
                    </td>
                    <td class="cell-tips">小程序appid</td>
                </tr>
                <tr>
                    <td class="cell-label">pagepath</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.pagepath"></el-input>
                    </td>
                    <td class="cell-tips">小程序pagepath</td>
                </tr>
                <tr>
                    <td class="cell-label">url</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.url"></el-input>
                    </td>
                    <td class="cell-tips">不支持小程序的老版本客户端将打开本url</td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td class="cell-label">菜单KEY值</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.key"></el-input>
                    </td>
                    <td class="cell-tips">用于消息接口推送，不超过128字节</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <el-button type="primary" size="medium" class="w100" @click="handleSave">提交</el-button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "WechatMenu",
        data () {
            return {
                id: 0,
                menu: {},
                items: [],
                types: [],
                showDialog: false
            }
        },
        mounted() {
            this.fetchList();
            this.fetchTypes();
        },
        methods: {
            fetchList () {
                this.$get('/wechat/menu.getList').then(response => {
                    this.items = response.result.items;
                });
            },
            fetchTypes () {
                this.$get('/wechat/menu.getTypes').then(response => {
                    this.types = response.result.items;
                });
            },
            saveData(cb) {
                this.$post('/wechat/menu.save', {
                    id: this.id,
                    menu: this.menu
                }).then(response => {
                    this.resetData();
                    this.fetchList();
                    if (cb) cb(response);
                });
            },
            resetData() {
                this.id = '';
                this.menu = {};
            },
            handleDelete(id) {
                this.$confirm('此操作将永久删除所选菜单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/wechat/menu.delete', {id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSave() {
                if (!this.menu.name) {
                    this.$showToast('请填写菜单名称');
                    return false;
                }
                if (!this.menu.type) {
                    this.$showToast('请选择菜单类型');
                    return false;
                }
                this.showDialog = false;
                this.saveData();
            },
            handleAddMenu() {
                this.resetData();
                this.showDialog = true;
            },
            handleAddChildren(parent_id) {
                this.resetData();
                this.menu.parent_id = parent_id;
                this.showDialog = true;
            },
            handleShowEdit(menu) {
                this.menu = menu;
                this.id = menu.id;
                this.showDialog = true;
            },
            handleApplyMenu() {
                this.$confirm('注意，此操作将会替换公众号的现有菜单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/wechat/menu.apply').then(response => {
                        if (response.result.errcode) {
                            this.$showToast(response.result.errmsg);
                        } else {
                            this.$showToast('菜单应用成功');
                        }
                    });
                });
            },
        }
    }
</script>

<style scoped>

</style>
