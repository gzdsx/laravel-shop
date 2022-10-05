<template>
    <div class="content-block">
        <div class="console-title">
            <div class="float-right">
                <div class="display-flex">
                    <el-input size="small" placeholder="文章标题" style="margin-right: 5px;" v-model="q"></el-input>
                    <el-button size="small" type="primary" @click="handleSearch">搜索</el-button>
                </div>
            </div>
            <h2>我的收藏夹</h2>
        </div>

        <div class="dsxui-tabs-container">
            <ul class="dsxui-tabs">
                <li class="tab-item">
                    <router-link to="/collect/post" class="tab-link active">文章</router-link>
                </li>
                <li class="tab-item">
                    <router-link to="/collect/product" class="tab-link">商品</router-link>
                </li>
            </ul>
        </div>

        <section class="section">
            <table class="dsxui-listtable">
                <thead>
                <tr>
                    <th>文章标题</th>
                    <th width="200">收藏时间</th>
                    <th width="85" class="align-right">选项</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items" :key="index">
                    <td>
                        <h3 class="title"><a :href="item.post.url" target="_blank">{{item.post.title}}</a></h3>
                    </td>
                    <td>{{item.created_at}}</td>
                    <td class="align-right">
                        <el-popconfirm
                                title="确定要取消此收藏吗？"
                                @onConfirm="handleDelete(item.aid)"
                        >
                            <a slot="reference">取消收藏</a>
                        </el-popconfirm>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="display-flex" style="margin-top: 5px;">
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
        </section>
    </div>
</template>

<script>
    export default {
        name: "PostCollect",
        components: {},
        data() {
            return {
                q: '',
                items: [],
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
                this.$get('/post/collect/batchget', {
                    q: this.q,
                    offset: this.offset
                }).then(response => {
                    this.items = response.result.items;
                });
            },
            handleDelete(aid) {
                this.$post('/post/collect/delete', {items: [aid]}).then(response => {
                    this.fetchList();
                });
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleSearch() {
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
