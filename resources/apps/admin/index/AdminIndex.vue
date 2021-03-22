<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>仪表板</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="dashboard">
                <div class="dashboard-left">
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>关键指数</strong>
                        </div>
                        <div class="index-module">
                            <div class="module">
                                <div class="tips">用户</div>
                                <p class="num">{{counts.user}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">订单</div>
                                <p class="num">{{counts.order}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">产品</div>
                                <p class="num">{{counts.product}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">文章</div>
                                <p class="num">{{counts.post}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">视频</div>
                                <p class="num">{{counts.video}}</p>
                            </div>
                            <div class="module">
                                <div class="tips">素材</div>
                                <p class="num">{{counts.material}}</p>
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
                                    <span class="iconfont icon-setting-fill"></span>
                                </div>
                                <div class="tips">店铺设置</div>
                            </router-link>
                            <router-link to="/user/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-peoplefill"></span>
                                </div>
                                <div class="tips">用户管理</div>
                            </router-link>
                            <router-link to="/product/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-goodsfill"></span>
                                </div>
                                <div class="tips">商品管理</div>
                            </router-link>
                            <router-link to="/product/category" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-dashboard-fill"></span>
                                </div>
                                <div class="tips">产品分类</div>
                            </router-link>
                            <router-link to="/post/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-formfill"></span>
                                </div>
                                <div class="tips">文章管理</div>
                            </router-link>
                            <router-link to="/post/category" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-round_menu_fill"></span>
                                </div>
                                <div class="tips">文章分类</div>
                            </router-link>

                            <router-link to="/page/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-round_text_fill"></span>
                                </div>
                                <div class="tips">页面管理</div>
                            </router-link>
                            <router-link to="/material/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-picfill"></span>
                                </div>
                                <div class="tips">素材管理</div>
                            </router-link>
                            <router-link to="/link/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-round_link_fill"></span>
                                </div>
                                <div class="tips">友情链接</div>
                            </router-link>
                            <router-link to="/block/list" class="module">
                                <div class="icon">
                                    <span class="iconfont icon-slack-circle-fill"></span>
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
                            <li v-for="(p,idx) in posts">
                                <span>{{formatData(p.created_at)}}</span>
                                <a :href="p.url" target="_blank">{{p.title}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="dashboard-content">
                        <div class="dashboard-title">
                            <strong>新用户</strong>
                        </div>
                        <ul class="newuser">
                            <li v-for="(user,idx) in users">
                                <img :src="user.avatar" class="avatar" alt="">
                                <div class="username">{{user.username}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    export default {
        name: "AdminIndex",
        components:{
            AdminFrame
        },
        data() {
            return {
                posts: [],
                counts: {},
                users: [],
            }
        },
        mounted() {
            this.$store.commit('signin',{
                uid:1000000,
                username:'大师兄'
            })
            this.$get('/dashboard/posts').then(response => {
                this.posts = response.data.items;
            });

            this.$get('/dashboard/counts').then(response => {
                this.counts = response.data.counts;
            });

            this.$get('/dashboard/newuser').then(response => {
                this.users = response.data.items;
            });
        },
        methods: {
            formatData(date) {
                const d = new Date(date);
                return d.getFullYear() + '/' + (d.getMonth() + 1) + '/' + d.getDay();
            }
        }
    }
</script>

<style scoped>

</style>
