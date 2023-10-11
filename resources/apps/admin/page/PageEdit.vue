<template>
    <main-layout>
        <h2 slot="header">编辑页面</h2>
        <div class="post-body">
            <div class="post-body-main">
                <div class="page-section">
                    <table class="dsxui-formtable">
                        <tr>
                            <td class="w60">标题</td>
                            <td>
                                <el-input size="medium" class="w-100" v-model="page.title"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="w60">别名</td>
                            <td>
                                <el-input size="medium" class="w-100" v-model="page.name"/>
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
                    <table class="dsxui-formtable">
                        <tr>
                            <td class="w60">摘要</td>
                            <td>
                                <el-input type="textarea" rows="5" class="w-100" v-model="page.excerpt"></el-input>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="post-body-box">
                <div class="post-card">
                    <div class="post-card-header">
                        <h2>特色图片</h2>
                    </div>
                    <div class="post-card-body">
                        <div class="feature-image-box" @click="showMediaDialog=true">
                            <img :src="page.image" v-if="page.image" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <fixed-bottom>
            <el-button class="w100" :disabled="disabled" @click="$router.go(-1)">取消</el-button>
            <el-button class="w100" :disabled="disabled" type="primary" @click="onSubmit">保存</el-button>
        </fixed-bottom>
        <media-dialog v-model="showMediaDialog" @confirm="onChooseImage"/>
    </main-layout>
</template>

<script>
export default {
    name: "PageEdit",
    data() {
        return {
            page: {},
            disabled: false,
            showMediaDialog: false
        }
    },
    methods: {
        fetchData() {
            let {id} = this.$route.params;
            if (!id) return;
            this.$get('/page', {id}).then(response => {
                this.page = response.result;
            });
        },
        onSubmit() {
            let {page} = this;
            if (!page.title) {
                this.$message.error('请填写页面标题');
                return false;
            }

            this.disabled = true;
            this.$post('/page', {page}).then((res) => {
                this.$message.success('页面保存成功');
                this.$router.replace('/page/edit/' + res.result.id);
            });
        },
        resetData() {
            this.page = {
                title: '',
                name: '',
                image: '',
                content: ''
            };
        },
        onChooseImage(media) {
            this.page.image = media.url;
        },
    },
    mounted() {
        this.resetData();
        this.fetchData();
    },
}
</script>

<style scoped>

</style>
