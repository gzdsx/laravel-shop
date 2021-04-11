<template>
    <div class="content-block">
        <div class="console-title">
            <div class="float-right">
                <div class="display-flex">
                    <el-input size="small" placeholder="商品名称" style="margin-right: 5px;" v-model="q"></el-input>
                    <el-button size="small" type="primary" @click="handleSearch">搜索</el-button>
                </div>
            </div>
            <h2>我的收藏夹</h2>
        </div>

        <div class="dsxui-tabs-container">
            <ul class="dsxui-tabs">
                <li class="tab-item">
                    <router-link to="/collect/post" class="tab-link">文章</router-link>
                </li>
                <li class="tab-item">
                    <router-link to="/collect/product" class="tab-link active">商品</router-link>
                </li>
            </ul>
        </div>

        <section class="section">
            <table class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="50">图片</th>
                    <th>商品名称</th>
                    <th width="100">价格</th>
                    <th width="200">收藏时间</th>
                    <th width="85" class="align-right">选项</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items" :key="index">
                    <td>
                        <img :src="item.image" width="50" height="50" alt="">
                    </td>
                    <td>
                        <h3 class="title"><a :href="item.product.url" target="_blank">{{item.title}}</a></h3>
                    </td>
                    <td><span class="amount">{{item.price}}</span></td>
                    <td>{{item.created_at}}</td>
                    <td class="align-right">
                        <el-popconfirm
                                title="确定要取消此收藏吗？"
                                @onConfirm="handleDelete(item.itemid)"
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
        name: "ProductCollect",
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
                this.$get('/product/collect/batchget', {
                    q: this.q,
                    offset: this.offset
                }).then(response => {
                    this.items = response.result.items;
                });
            },
            handleDelete(itemid) {
                this.$post('/product/collect/delete', {items: [itemid]}).then(response => {
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
