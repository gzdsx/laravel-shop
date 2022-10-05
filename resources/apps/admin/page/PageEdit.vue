<template>
    <div>
        <header class="page-header">
            <div class="page-title">编辑页面</div>
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
                            <el-select size="medium" class="w300" v-model="page.cate_id">
                                <el-option
                                        v-for="(category,index) in categoryList"
                                        :value="category.cate_id"
                                        :label="category.cate_name"
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
            <el-button class="w100" :disabled="disabled" @click="$router.go(-1)">取消</el-button>
            <el-button class="w100" :disabled="disabled" type="primary" @click="onSubmit">保存</el-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PageEdit",
        data() {
            return {
                page: {},
                categoryList: [],
                disabled: false
            }
        },
        methods: {
            fetchData() {
                let {id} = this.$route.params;
                if (!id) return;
                this.$get('/page/page.getInfo', {id}).then(response => {
                    this.page = response.result;
                });
            },
            fetchCategoryList() {
                this.$get('/page/category.getList').then(response => {
                    this.categoryList = response.result.items;
                });
            },
            onSubmit() {
                let {page} = this;
                let {id} = page;
                if (!page.title) {
                    this.$showToast('请填写页面标题');
                    return false;
                }

                if (!page.cate_id) {
                    this.$showToast('请选择页面分类');
                    return false;
                }

                this.disabled = true;
                this.$post('/page/page.save', {id, page}).then(response => {
                    this.$showToast('页面保存成功', () => {
                        this.$router.go(0);
                    });
                });
            },
            resetData() {
                this.page = {
                    title: '',
                    cate_id: 0,
                    alias: '',
                    template: '',
                    content: ''
                };
            }
        },
        mounted() {
            this.resetData();
            this.fetchData();
            this.fetchCategoryList();
        },
    }
</script>

<style scoped>

</style>
