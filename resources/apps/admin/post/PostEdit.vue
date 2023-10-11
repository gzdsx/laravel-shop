<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">编辑文章</h2>
            <div class="d-flex column-gap-10">
                <a :href="post.url" target="_blank" v-if="post.url">
                    <el-button size="small">预览</el-button>
                </a>
                <router-link to="/post/edit">
                    <el-button size="small" type="primary">添加文章</el-button>
                </router-link>
            </div>
        </div>
        <section class="post-body">
            <div class="post-body-main">
                <div class="page-section">
                    <table class="dsxui-formtable">
                        <tr>
                            <td class="w80">文章标题</td>
                            <td>
                                <el-input type="text" size="medium" placeholder="在这里输入标题"
                                          v-model="post.title"></el-input>
                            </td>
                        </tr>
                    </table>
                    <table class="dsxui-formtable">
                        <tr>
                            <td class="w80">文章别名</td>
                            <td>
                                <el-input type="text" size="medium" class="w300" v-model="post.alias"></el-input>
                            </td>
                            <td class="w80">文章作者</td>
                            <td>
                                <el-input type="text" size="medium" class="w300" v-model="post.author"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td>评论设置</td>
                            <td>
                                <el-checkbox :true-label="1" :false-label="0" v-model="post.allow_comment">允许评论
                                </el-checkbox>
                            </td>
                            <td>文章标签</td>
                            <td>
                                <el-input type="text" size="medium" class="w300" v-model="post.tags"></el-input>
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
                                <el-input type="textarea" rows="5" class="w-100" v-model="post.excerpt"></el-input>
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
            <div class="post-body-box">
                <div class="post-card">
                    <div class="post-card-header">
                        <h2>分类</h2>
                    </div>
                    <div class="post-card-body">
                        <div class="category-box">
                            <el-checkbox-group v-model="selectedCategories" @change="onChange">
                                <category-checkbox-list :categories="categories"/>
                            </el-checkbox-group>
                        </div>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-card-header">
                        <h2>特色图片</h2>
                    </div>
                    <div class="post-card-body">
                        <div class="feature-image-box" @click="showMediaDialog=true">
                            <img :src="post.image" v-if="post.image" alt="">
                        </div>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-card-header">
                        <h2>其他</h2>
                    </div>
                    <div class="post-card-body">
                        <div class="form-label">文章形式</div>
                        <el-select size="medium" class="w-100" v-model="post.format">
                            <el-option value="article" label="文章">文章</el-option>
                            <el-option value="gallery" label="相册">相册</el-option>
                            <el-option value="video" label="视频">视频</el-option>
                        </el-select>
                        <div class="form-label">文章来源</div>
                        <div>
                            <el-input type="text" size="medium" class="w-100" v-model="post.from"/>
                        </div>
                        <div class="form-label">来源地址</div>
                        <div>
                            <el-input type="text" size="medium" class="w-100" v-model="post.fromurl"></el-input>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <fixed-bottom slot="footer">
            <el-button @click="onSubmit('draft')">存入草稿</el-button>
            <el-button type="primary" @click="onSubmit('publish')">{{ post.id ? '更新' : '发布' }}</el-button>
        </fixed-bottom>
        <media-dialog v-model="showMediaDialog" :options="{type:'image'}" @confirm="onChooseImage"/>
    </main-layout>
</template>

<script>
import CategoryCheckboxList from "../components/CategoryCheckboxList";

export default {
    name: "PostEdit",
    components: {CategoryCheckboxList},
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
            showMediaDialog: false,
            pickImageType: 1,
            categories: [],
            selectedCategories: [],
            metas: []
        }
    },
    methods: {
        fetchData() {
            let {id} = this.$route.params;
            this.$get('/post', {id}).then(response => {
                this.post = response.result;
                const {content, images, media, categories} = this.post;
                this.selectedCategories = categories.map(cate => cate.cate_id);
                if (content) this.content = content.content;
                if (images) this.images = images;
                if (media) this.media = media;
            });
        },
        fetchCategories() {
            this.$get('/categories', {taxonomy: 'category'}).then(response => {
                this.categories = response.result.items;
                //this.nodes = this.serilazeProps(response.result.items);
            });
        },
        onChooseImage(media) {
            this.post.image = media.url;
        },
        onSubmit(status) {
            let {post, content, images, media, selectedCategories, metas} = this;

            let {title} = post;
            if (!title) {
                this.$message.error('请填写文章标题');
                return false;
            }
            if (!selectedCategories.length === 0) {
                this.$message.error('请选择文章分类');
                return false;
            }
            post.status = status;

            let {id} = post;
            let categories = selectedCategories;
            this.$post('/post', {id, post, content, images, media, categories, metas}).then((res) => {
                this.$message.success(id ? '文章更新成功' : '文章保存成功');
                this.$router.replace('/post/edit/' + res.result.id);
            }).catch(reason => {
                this.$notify({
                    message: reason.message,
                    type: 'success'
                });
            });
        }
    },
    mounted() {
        this.fetchData();
        this.fetchCategories();
    },
}
</script>

<style scoped>

</style>
