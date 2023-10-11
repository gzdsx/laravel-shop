<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">素材管理</h2>
            <div>
                <el-button type="primary" size="small">添加素材</el-button>
            </div>
        </div>

        <section class="page-section">
            <el-table :data="items" style="width: 100%" @selection-change="handleSelectionChange">
                <el-table-column prop="media_id" width="45" type="selection"/>
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
                <el-table-column prop="name" label="名称"/>
                <el-table-column prop="media_id" label="media_id"/>
                <el-table-column prop="url" label="url"/>
                <el-table-column prop="url" label="创建时间" v-if="type==='news'"/>
            </el-table>
            <div class="tablenav-bottom">
                <div class="table-actions">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="handleDelete">
                        批量删除
                    </el-button>
                </div>
                <el-pagination
                    background
                    layout="prev, pager, next, total"
                    :total="total"
                    :page-size="pageSize"
                    @current-change="handlePageChange"
                >
                </el-pagination>
            </div>
        </section>
    </main-layout>
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
                this.$get('/wechat/materials', {
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
                    this.$post('/wechat/material/delete', {ids}).then(() => {
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
                return '/wechat/material/image?media_id=' + media_id
            }
        }
    }
</script>

<style scoped>

</style>
