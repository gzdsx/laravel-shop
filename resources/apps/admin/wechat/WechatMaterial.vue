<template>
    <div>
        <header class="page-header">
            <div class="page-title">素材管理</div>
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
                <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
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
                            @current-change="handlePageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WechatMaterial",
        data () {
            return {
                items: [],
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
                this.$get('/wechat/material.getList', {
                    type: this.type,
                    offset: this.offset
                }).then(response => {
                    this.items = response.result.items;
                    this.total = response.result.total;
                });
            },
            handleSelectionChange (val) {
                this.selectionIds = val;
            },
            handleDelete () {
                let ids = this.selectionIds.map((d) => d.media_id);
                this.$confirm('此操作将永久删除所选文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/wechat/material.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            handlePageChange (page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch () {
                this.fetchList();
            },
            handleTabClick (tab) {
                this.type = tab.name;
                this.offset = 0;
                this.fetchList();
            },
            getImageUrl(media_id) {
                return '/wechat/material.image?media_id=' + media_id
            }
        }
    }
</script>

<style scoped>

</style>
