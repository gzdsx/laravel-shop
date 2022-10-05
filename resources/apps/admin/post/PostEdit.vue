<template>
    <div>
        <header class="page-header">
            <div class="page-title">编辑文章</div>
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
                            <el-cascader
                                    :options="nodes"
                                    size="medium"
                                    class="w300"
                                    :clearable="true"
                                    style="height: 36px;"
                                    @change="onSascaderChange"
                                    v-model="post.cate_id"
                            ></el-cascader>
                        </td>
                        <td class="w80">文章来源</td>
                        <td class="w400">
                            <el-input type="text" size="medium" class="w300" v-model="post.from"/>
                        </td>
                        <td rowspan="5" class="align-center">
                            <div class="img-150" title="点击更换图片" @click="showImagePicker=true">
                                <el-image :src="post.image" object-fit="cover" class="img-150">
                                    <div slot="error" class="image-slot">
                                        <i class="el-icon el-icon-picture-outline"></i>
                                    </div>
                                </el-image>
                                <p class="align-center">文章配图</p>
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
                            <el-radio-group v-model="post.type">
                                <el-radio label="article">文章</el-radio>
                                <el-radio label="image">相册</el-radio>
                                <el-radio label="video">视频</el-radio>
                            </el-radio-group>
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
                            <vue-editor v-model="content"></vue-editor>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button @click="onSubmit(0)">存入草稿</el-button>
            <el-button type="primary" @click="onSubmit(1)">立即发布</el-button>
        </div>
        <image-picker v-model="showImagePicker" @confirm="onChooseImage"/>
    </div>
</template>

<script>
    export default {
        name: "PostEdit",
        data() {
            return {
                post: {
                    type: 'article',
                    allowcomment: 1,
                    views: 0
                },
                content: '',
                images: [],
                media: {},
                showImagePicker: false,
                pickImageType: 1,
                nodes: [],
            }
        },
        methods: {
            fetchData() {
                let {aid} = this.$route.params;
                this.$get('/post/item.getInfo', {aid}).then(response => {
                    this.post = response.result;
                    const {content, images, media} = this.post;
                    if (content) this.content = content.content;
                    if (images) this.images = images;
                    if (media) this.media = media;
                });
            },
            fetchCategoryList() {
                this.$get('/post/category.getList').then(response => {
                    this.nodes = this.serilazeProps(response.result.items);
                });
            },
            onChooseImage(data) {
                this.post.image = data.image;
            },
            onSubmit(state) {
                let {post, content, images, media} = this;

                let {title, cate_id} = post;
                if (!title) {
                    this.$showToast('请填写文章标题');
                    //this.$message.error('请填写文章标题');
                    return false;
                }
                if (!cate_id) {
                    this.$message.error('请选择文章分类');
                    return false;
                }
                post.state = state;

                let {aid} = post;
                this.$post('/post/item.save', {aid, post, content, images, media}).then(() => {
                    this.$showToast('文章保存成功', () => this.$router.go(0));
                }).catch(reason => {
                    this.$showToast(reason.errMsg);
                });
            },
            serilazeProps(arr) {
                function t(a) {
                    return a.map(function (c) {
                        var obj = {
                            value: c.cate_id,
                            label: c.cate_name,
                        };
                        if (c.children.length > 0) {
                            obj.children = t(c.children);
                        }
                        return obj;
                    });
                }

                return t(arr);
            },
            onSascaderChange(arr) {
                if (arr) {
                    this.post.cate_id = arr[arr.length - 1];
                }
            }
        },
        mounted() {
            this.fetchData();
            this.fetchCategoryList();
        },
    }
</script>

<style scoped>

</style>
