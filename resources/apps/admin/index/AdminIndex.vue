<template>
    <main-layout>
        <h2 slot="header">仪表板</h2>
        <section>
            <div class="dashboard">
                <div class="dashboard-left">
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>关键指数</strong>
                        </div>
                        <div class="index-module">
                            <div class="module">
                                <div class="tips">用户</div>
                                <p class="num">{{stats.users}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">订单</div>
                                <p class="num">{{stats.orders}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">产品</div>
                                <p class="num">{{stats.products}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">文章</div>
                                <p class="num">{{stats.posts}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">素材</div>
                                <p class="num">{{stats.materials}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>快捷功能</strong>
                        </div>
                        <div class="quick-operation">
                            <router-link to="/settings" class="module">
                                <div class="icon">
                                    <i class="bi bi-gear-fill"></i>
                                </div>
                                <div class="tips">系统设置</div>
                            </router-link>
                            <router-link to="/user/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="tips">用户管理</div>
                            </router-link>
                            <router-link to="/post/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <div class="tips">文章管理</div>
                            </router-link>
                            <router-link to="/post/category" class="module">
                                <div class="icon">
                                    <i class="bi bi-bookmarks-fill"></i>
                                </div>
                                <div class="tips">文章分类</div>
                            </router-link>

                            <router-link to="/page/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-box-fill"></i>
                                </div>
                                <div class="tips">页面管理</div>
                            </router-link>
                            <router-link to="/material/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-images"></i>
                                </div>
                                <div class="tips">素材管理</div>
                            </router-link>
                            <router-link to="/link/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-browser-chrome"></i>
                                </div>
                                <div class="tips">友情链接</div>
                            </router-link>
                            <router-link to="/block/list" class="module">
                                <div class="icon">
                                    <i class="bi bi-server"></i>
                                </div>
                                <div class="tips">内容模块</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="dashboard-right">
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>动态</strong>
                        </div>
                        <ul class="activity">
                            <li v-for="(p,idx) in postList">
                                <span>{{formatTime(p.created_at)}}</span>
                                <a :href="p.url" target="_blank">{{p.title}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>新用户</strong>
                        </div>
                        <ul class="newuser">
                            <li v-for="(user,idx) in userList">
                                <img :src="user.avatar" class="avatar" alt="">
                                <div class="username">{{user.nickname}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main-layout>
</template>

<script>
    export default {
        name: "AdminIndex",
        data() {
            return {
                postList: [],
                userList: [],
                stats: {
                    users: 0,
                    posts: 0,
                    materials: 0,
                    products: 0,
                    orders: 0
                }
            }
        },
        mounted() {
            this.$get('/dashboard/posts').then(response => {
                this.postList = response.result.items;
            });

            this.$get('/dashboard/users').then(response => {
                this.userList = response.result.items;
            });

            this.$get('/dashboard/stats').then(response => {
                this.stats = {
                    ...this.stats,
                    ...response.result
                };
            });
        },
        methods: {
            formatTime(t) {
                const date = new Date(t.replace(/-/g, '/'));
                var y = date.getFullYear(), m = date.getMonth() + 1, d = date.getDate();
                if (m < 10) m = '0' + m;
                if (d < 10) d = '0' + d;
                return y + '/' + m + '/' + d;
            }
        }
    }
</script>

<style scoped>

</style>
