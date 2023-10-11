<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">菜单管理</h2>
            <div class="d-flex">
                <el-button type="primary" size="small" @click="onShowAdd">添加菜单</el-button>
                <el-button type="primary" size="small" @click="onApplyMenu">应用菜单</el-button>
            </div>
        </div>
        <div class="page-section">
            <div class="tablenav-top">
                <h2>菜单列表</h2>
                <p class="font-12 font-normal">最多仅支持三个一级菜单，每个一级菜单最多仅支持5个二级菜单</p>
            </div>
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
                            <td><span style="font-weight: 500;">{{ item.name }}</span></td>
                            <td>{{ item.type_des }}</td>
                            <td class="align-right">
                                <div class="action-links">
                                    <a @click="onShowEdit(item)">编辑</a>
                                    <span>|</span>
                                    <a @click="onDelete(item.id)">删除</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-if="item.children && item.children.length>0">
                        <tr v-for="(child,idx2) in item.children" :key="idx2">
                            <td>
                                <span class="child-item-icon"></span>
                                <span>{{ child.name }}</span>
                            </td>
                            <td>{{ child.type_des }}</td>
                            <td class="align-right">
                                <div class="action-links">
                                    <a @click="onShowEdit(child)">编辑</a>
                                    <span>|</span>
                                    <a @click="onDelete(child.id)">删除</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td colspan="3">
                                <el-button size="small" type="text" @click="onShowAddChild(item.id)">
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
        <el-dialog title="编辑菜单" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
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
                        <el-input size="medium" v-model="menu.name"/>
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
                            />
                        </el-select>
                    </td>
                    <td class="cell-tips">点击菜单后所执行的操作</td>
                </tr>
                </tbody>
                <tbody v-if="menu.type==='view'">
                <tr>
                    <td class="cell-label">网页链接</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.url"/>
                    </td>
                    <td class="cell-tips">用户点击菜单可打开链接，不超过1024字节</td>
                </tr>
                </tbody>
                <tbody v-else-if="menu.type==='media_id'">
                <tr>
                    <td class="cell-label">永久素材ID</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.media_id"/>
                    </td>
                    <td class="cell-tips">填写永久素材的合法media_id</td>
                </tr>
                </tbody>
                <tbody v-else-if="menu.type==='miniprogram'">
                <tr>
                    <td class="cell-label">appId</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.appid"/>
                    </td>
                    <td class="cell-tips">小程序appid</td>
                </tr>
                <tr>
                    <td class="cell-label">pagepath</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.pagepath"/>
                    </td>
                    <td class="cell-tips">小程序pagepath</td>
                </tr>
                <tr>
                    <td class="cell-label">url</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.url"/>
                    </td>
                    <td class="cell-tips">不支持小程序的老版本客户端将打开本url</td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td class="cell-label">菜单KEY值</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="menu.key"/>
                    </td>
                    <td class="cell-tips">用于消息接口推送，不超过128字节</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <el-button type="primary" size="medium" class="w100" @click="onSubmit">提交</el-button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </main-layout>
</template>

<script>
export default {
    name: "WechatMenu",
    data() {
        return {
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
        fetchList() {
            this.$get('/wechat/menus').then(response => {
                this.items = response.result.items;
            });
        },
        fetchTypes() {
            this.$get('/wechat/menu/types').then(response => {
                this.types = response.result.items;
            });
        },
        onSubmit() {
            let {menu} = this;
            if (!menu.name) {
                this.$message.error('请填写菜单名称');
                return false;
            }
            if (!menu.type) {
                this.$message.error('请选择菜单类型');
                return false;
            }

            this.$post('/wechat/menu', {menu}).then(response => {
                this.resetData();
                this.fetchList();
                this.showDialog = false;
                this.$message.success('菜单已保存');
            });
        },
        resetData() {
            this.menu = {};
        },
        onDelete(id) {
            this.$confirm('此操作将永久删除所选菜单, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/wechat/menu/delete', {id}).then(response => {
                    this.fetchList();
                });
            });
        },
        onShowAdd() {
            this.resetData();
            this.showDialog = true;
        },
        onShowAddChild(id) {
            this.resetData();
            this.menu.parent_id = id;
            this.showDialog = true;
        },
        onShowEdit(d) {
            this.menu = d;
            this.showDialog = true;
        },
        onApplyMenu() {
            this.$confirm('注意，此操作将会替换公众号的现有菜单, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$post('/wechat/menu/apply').then(response => {
                    if (response.result.errcode) {
                        this.$message.error(response.result.errmsg);
                    } else {
                        this.$message.success('菜单应用成功');
                    }
                });
            });
        },
    }
}
</script>

<style scoped>

</style>
