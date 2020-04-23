<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>微信管理</el-breadcrumb-item>
                <el-breadcrumb-item>素材管理</el-breadcrumb-item>
            </el-breadcrumb>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs @tab-click="handleTabClick" value="image">
                        <el-tab-pane label="图片" name="image"></el-tab-pane>
                        <el-tab-pane label="视频" name="video"></el-tab-pane>
                        <el-tab-pane label="声音" name="voice"></el-tab-pane>
                        <el-tab-pane label="文章" name="news"></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="small">添加素材</el-button>
                    </div>
                </div>
                <el-table :data="itemList" style="width: 100%" @selection-change="handleSelectionChange">
                    <el-table-column prop="media_id" width="45" type="selection"></el-table-column>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image :src="getImageUrl(scope.row.media_id)" style="width: 50px; height: 50px;"
                                      v-if="type==='image'"></el-image>
                            <el-image :src="getImageUrl(scope.row.thumb_media_id)" style="width: 50px; height: 50px;"
                                      v-if="type==='news'"></el-image>
                            <el-image src="/images/common/video.png" style="width: 50px; height: 50px;"
                                      v-if="type==='video'"></el-image>
                            <el-image src="/images/common/audio.png" style="width: 50px; height: 50px;"
                                      v-if="type==='voice'"></el-image>
                        </template>
                    </el-table-column>
                    <el-table-column prop="name" label="名称"></el-table-column>
                    <el-table-column prop="media_id" label="media_id"></el-table-column>
                    <el-table-column prop="url" label="url"></el-table-column>
                    <el-table-column prop="url" label="创建时间" v-if="type==='news'"></el-table-column>
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
                            @current-change="handlerPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "WechatMaterial",
        components: {
            AdminFrame
        },
        data: function () {
            return {
                itemList: [],
                total: 0,
                offset: 0,
                pageSize: 15,
                selectionIds: [],
                type: 'image'
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/admin/wechat/material/batchget', {
                    type: this.type,
                    offset: this.offset
                }).then(response => {
                    this.itemList = response.data.items;
                    this.total = response.data.total;
                });
            },
            handleSelectionChange: function (val) {
                this.selectionIds = val;
            },
            handleDelete: function () {
                var items = this.selectionIds.map((d) => d.media_id);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/admin/wechat/material/delete', {items}).then(response => {
                        this.fetchList();
                    });
                });
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch: function () {
                this.fetchList();
            },
            handleTabClick: function (tab) {
                this.type = tab.name;
                this.offset = 0;
                this.itemList = [];
                this.fetchList();
            },
            getImageUrl(media_id) {
                return '/admin/wechat/material/viewimage?media_id=' + media_id
            }
        }
    }
</script>

<style scoped>

</style>
