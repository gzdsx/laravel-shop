<template>
    <div>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>页面管理</el-breadcrumb-item>
                    <el-breadcrumb-item>编辑页面</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/page/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <tr>
                        <td class="w60">标题</td>
                        <td>
                            <el-input size="medium" class="w300" v-model="page.title"></el-input>
                        </td>
                        <td class="w60">别名</td>
                        <td>
                            <el-input size="medium" class="w300" v-model="page.alias"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>分类</td>
                        <td>
                            <el-select size="medium" class="w300" v-model="page.catid">
                                <el-option
                                        v-for="(category,index) in categories"
                                        :value="category.pageid"
                                        :label="category.title"
                                        :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                        <td>模板</td>
                        <td>
                            <el-input size="medium" class="w300" v-model="page.template"></el-input>
                        </td>
                    </tr>
                </table>
                <table class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="w60">内容</td>
                        <td>
                            <vue-editor v-model="page.content"></vue-editor>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button class="w100" @click="$router.go(-1)">取消</el-button>
            <el-button class="w100" type="primary" @click="handleSubmit">保存</el-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PageEdit",
        data() {
            return {
                id: 0,
                page: {
                    title: '',
                    catid: '',
                    alias: '',
                    template: '',
                    content: ''
                },
                categories: []
            }
        },
        mounted() {
            this.id = this.$route.query.id | 0;
            if (this.id) this.fetchData();
            this.fetchCategories();
        },
        methods: {
            fetchData() {
                this.$get('/page/get', {id: this.id}).then(response => {
                    this.page = response.result.page;
                });
            },
            fetchCategories() {
                this.$get('/page/category/getall').then(response => {
                    this.categories = response.result.items;
                });
            },
            handleSubmit() {
                if (!this.page.title) {
                    this.$showToast('请填写页面标题');
                    return false;
                }

                if (!this.page.catid) {
                    this.$showToast('请选择页面分类');
                    return false;
                }

                this.$post('/page/save', {
                    id: this.id,
                    page: this.page
                }).then(response => {
                    this.$showToast('页面保存成功', () => this.$router.go(0));
                });
            }
        }
    }
</script>

<style scoped>

</style>
