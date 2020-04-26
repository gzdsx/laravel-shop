<template>
    <admin-frame>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>文章管理</el-breadcrumb-item>
                    <el-breadcrumb-item>编辑文章</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/post/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <tr>
                        <td class="w80">文章标题</td>
                        <td>
                            <el-input type="text" size="medium" placeholder="在这里输入标题" v-model="post.title"></el-input>
                        </td>
                    </tr>
                </table>
                <table class="dsxui-formtable">
                    <tr>
                        <td class="w80">目录分类</td>
                        <td class="w400">
                            <el-select size="medium" class="w300" placeholder="请选择" v-model="post.catid">
                                <el-option
                                        v-for="(catlog,index) in catlogs"
                                        :value="catlog.catid"
                                        :label="catlog.name"
                                        :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                        <td class="w80">文章来源</td>
                        <td class="w400">
                            <el-input type="text" size="medium" class="w300" v-model="post.from"></el-input>
                        </td>
                        <td rowspan="5" style="text-align: center">
                            <div class="post-image-box" title="点击更换图片" @click="showPicker=true">
                                <div class="bg-cover w150 h150" :style="{'background-image':'url('+post.image+')'}"
                                     v-if="post.image"></div>
                                <div class="bg-cover w150 h150" v-else></div>
                                <p style="text-align: center; padding-top: 5px;">文章配图</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>文章别名</td>
                        <td>
                            <el-input type="text" size="medium" class="w300" v-model="post.alias"></el-input>
                        </td>
                        <td>来源地址</td>
                        <td>
                            <el-input type="text" size="medium" class="w300" v-model="post.fromurl"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>评论设置</td>
                        <td>
                            <el-checkbox :true-label="1" :false-label="0" v-model="post.allowcomment">允许评论</el-checkbox>
                        </td>
                        <td>文章标签</td>
                        <td>
                            <el-input type="text" size="medium" class="w300" v-model="post.tags"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>文章作者</td>
                        <td>
                            <el-input type="text" size="medium" class="w300" v-model="post.author"></el-input>
                        </td>
                        <td>文章形式</td>
                        <td>
                            <el-radio label="article" v-model="post.type">文章</el-radio>
                            <el-radio label="image" v-model="post.type">相册</el-radio>
                            <el-radio label="video" v-model="post.type">视频</el-radio>
                        </td>
                    </tr>
                    <tr>
                        <td>阅读价格</td>
                        <td>
                            <el-input type="number" size="medium" class="w300" v-model="post.price"></el-input>
                        </td>
                        <td>发布时间</td>
                        <td>
                            <el-input type="text" size="medium" class="w300" v-model="post.created_at"></el-input>
                        </td>
                    </tr>
                </table>
                <table class="dsxui-formtable">
                    <tr>
                        <td class="w80">内容摘要</td>
                        <td>
                            <el-input type="textarea" rows="5" class="w-100" v-model="post.summary"></el-input>
                        </td>
                    </tr>
                </table>
                <table class="dsxui-formtable">
                    <tr>
                        <td class="w80">文章内容</td>
                        <td>
                            <kind-editor v-model="post.content.content"></kind-editor>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button @click="submit(0)">存入草稿</el-button>
            <el-button type="primary" @click="submit(1)">立即发布</el-button>
        </div>
        <image-picker v-model="showPicker" @confirm="handlePickImage"></image-picker>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import KindEditor from "../../lib/KindEditor";
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "PostEdit",
        components: {
            AdminFrame,
            KindEditor,
            ImagePicker
        },
        data: function () {
            return {
                aid: 0,
                post: {
                    images: [],
                    content: {},
                    media: {},
                    type: 'article',
                    allowcomment: 1
                },
                catlogs: {},
                showPicker: false
            }
        },
        mounted() {
            this.aid = this.$route.params.aid||0;
            this.getPost();
            this.fetchCatlogs();
        },
        methods: {
            getPost: function () {
                this.$axios.get('/admin/post/get?aid=' + this.aid).then(response => {
                    this.post = response.data.post;
                    if (!this.post.content) {
                        this.post.content = {};
                    }

                    if (!this.post.images) {
                        this.post.images = [];
                    }

                    if (!this.post.media) {
                        this.post.media = {};
                    }
                });
            },
            fetchCatlogs: function () {
                this.$axios.get('/admin/post/catlog/getall').then(response => {
                    this.catlogs = response.data.items;
                });
            },
            onEditChange: function (content) {
                this.content.content = content;
            },
            handlePickImage: function (data) {
                this.post.image = data.image;
            },
            submit: function (state) {
                this.post.state = state;
                const {title, catid} = this.post;
                if (!title) {
                    this.$showToast('文章标题不能为空');
                    return false;
                }
                if (!catid) {
                    this.$showToast('请选择文章分类');
                    return false;
                }
                this.$axios.post('/admin/post/update', {
                    aid: this.aid,
                    post: this.post
                }).then(response => {
                    this.$showToast('文章更新成功', () => this.$router.go(0));
                }).catch(reason => {
                    console.log(reason.response);
                });
            }
        }
    }
</script>

<style scoped>

</style>
