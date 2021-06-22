<template>
    <div>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>直播管理</el-breadcrumb-item>
                <el-breadcrumb-item>直播列表</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header flex-row">
                    <div class="table-edit-title flex-fill">
                        <strong>话题列表</strong>
                    </div>
                    <div>
                        <router-link to="/live/edit" target="_blank">
                            <el-button type="primary" size="small">添加话题</el-button>
                        </router-link>
                    </div>
                </div>

                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="id" width="45" type="selection"></el-table-column>
                    <el-table-column prop="id" label="ID" width="50"></el-table-column>
                    <el-table-column prop="title" label="话题">
                        <template slot-scope="scope">
                            <a @click="handleShowLive(scope.row)">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="channel.name" width="100" label="频道"></el-table-column>
                    <el-table-column prop="state_des" width="100" label="状态"></el-table-column>
                    <el-table-column prop="views" width="100" label="观看人次"></el-table-column>
                    <el-table-column prop="start_at" width="170" label="开播时间"></el-table-column>
                    <el-table-column prop="created_at" width="170" label="创建时间"></el-table-column>
                    <el-table-column width="110" label="选项">
                        <template slot-scope="scope">
                            <router-link :to="'/live/invite?live_id='+scope.row.id" target="_blank">邀请码</router-link>
                            <span>|</span>
                            <router-link :to="'/live/edit?id='+scope.row.id" target="_blank">编辑</router-link>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next, total"
                            :total="total"
                            :page-size="pageSize"
                            @current-change="handlePageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
        <el-dialog title="直播话题" closeable :visible.sync="showDialog" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <tbody>
                <tr>
                    <td class="w100">过期时间:</td>
                    <td>{{live.expires_at}}</td>
                </tr>
                <tr>
                    <td>推流地址:</td>
                    <td>{{live.push_url}}</td>
                </tr>
                <tr>
                    <td>OBS推流地址:</td>
                    <td>{{live.obs_push_url}}</td>
                </tr>
                <tr>
                    <td>OBS串流秘钥:</td>
                    <td>{{live.obs_stream_name}}</td>
                </tr>
                </tbody>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "LiveList",
        data() {
            return {
                id: 0,
                live: {},
                items: [],
                selectionIds: [],
                showDialog: false,
                total: 0,
                offset: 0,
                pageSize: 15,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/live/batchget', {offset: this.offset}).then(response => {
                    this.items = response.result.items;
                });
            },
            handleSelectionChange(val) {
                this.selectionIds = val;
            },
            handleDelete() {
                var items = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选话题, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/live/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handleShowLive(d) {
                this.live = d;
                this.showDialog = true;
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
        }
    }
</script>

<style scoped>

</style>
