<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex-fill">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>直播管理</el-breadcrumb-item>
                    <el-breadcrumb-item>邀请码管理</el-breadcrumb-item>
                    <el-breadcrumb-item>{{live.title}}</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <header class="table-edit-header">
                    <div class="display-flex">
                        <div class="font-16 font-bold flex">
                            <span>直播邀请列表</span>
                        </div>
                        <div class="button-item">
                            <el-button type="primary" size="small" @click="handleCreateInvite">创建邀请码</el-button>
                        </div>
                    </div>
                </header>
                <el-table :data="items" :loading="loading" style="width: 100%"
                          @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="code" label="邀请码"></el-table-column>
                    <el-table-column prop="user.username" width="200" label="用户"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="创建时间"></el-table-column>
                    <el-table-column width="70" label="选项">
                        <template slot-scope="scope">
                            <span v-if="scope.row.user">已使用</span>
                            <a @click="handleViewInvite(scope.row)" v-else>查看</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog title="邀请信息" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <div class="align-center">
                <img :src="code">
                <p>{{invite.link}}</p>
                <p>请将二维码或邀请链接发给微信好友</p>
            </div>
        </el-dialog>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "LiveInvite",
        components: {
            AdminFrame
        },
        data() {
            return {
                live_id: 0,
                live: {},
                items: [],
                invite: {},
                showDialog: false,
                selectionIds: [],
                total: 0,
                offset: 0,
                pageSize: 15,
                loading: true,
                code: ''
            }
        },
        mounted() {
            this.live_id = this.$route.query.live_id;
            this.$get('/live/get', {id: this.live_id}).then(response => {
                this.live = response.data.live;
            });
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/live/invite/batchget', {
                    offset: this.offset,
                    live_id: this.live_id
                }).then(response => {
                    const {items, total} = response.data;
                    this.items = items;
                    this.total = total;
                    this.loading = false;
                });
            },
            handleDelete(id) {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/live/invite/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleCreateInvite() {
                this.$post('/live/invite/create', {live_id: this.live_id}).then(response => {
                    this.fetchList();
                });
            },
            handleViewInvite(d) {
                this.invite = d;
                this.code = '/admin/live/invite/code/' + d.id;
                this.showDialog = true;
            }
        }
    }
</script>

<style scoped>

</style>
