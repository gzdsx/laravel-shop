<template>
    <admin-frame>
        <header class="page-header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>运费设置</el-breadcrumb-item>
                <el-breadcrumb-item>编辑模板</el-breadcrumb-item>
            </el-breadcrumb>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <colgroup>
                        <col class="w80">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td>模板名称</td>
                        <td>
                            <el-input size="medium" class="w300" v-model="template.template_name"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <td>计价方式</td>
                        <td>
                            <el-radio :label="1" v-model="template.valuation">按件数</el-radio>
                            <el-radio :label="2" v-model="template.valuation">按重量(KG)</el-radio>
                        </td>
                    </tr>
                    <tr>
                        <td>默认运费</td>
                        <td>
                            <div class="display-flex align-items-center">
                                <el-input size="medium" class="w80" v-model="template.start_quantity"></el-input>
                                <div>{{template.valuation === 1 ? '件' : 'KG'}}内</div>
                                <el-input size="medium" class="w80" v-model="template.start_fee"></el-input>
                                <div>元;每增加</div>
                                <el-input size="medium" class="w80" v-model="template.growth_quantity"></el-input>
                                <div>{{template.valuation === 1 ? '件' : 'KG'}}</div>
                                <el-input size="medium" class="w80" v-model="template.growth_fee"></el-input>
                                <div>元</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>包邮条件</td>
                        <td>
                            <div class="display-flex align-items-center">
                                <el-input size="medium" class="w80" v-model="template.free_quantity"></el-input>
                                <div>{{template.valuation === 1 ? '件' : 'KG'}}以上包邮或者金额满</div>
                                <el-input size="medium" class="w80" v-model="template.free_amount"></el-input>
                                <div>以上包邮</div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button @click="$router.go(-1)" class="w100">取消</el-button>
            <el-button type="primary" @click="handleSubmit" class="w100">保存</el-button>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";

    export default {
        name: "FreightEdit",
        components: {
            AdminFrame
        },
        data() {
            return {
                template: {
                    valuation: 1
                },
                template_id: 0
            }
        },
        mounted() {
            const template_id = this.$route.query.template_id;
            if (template_id) {
                this.template_id = template_id;
                this.fetchData();
            }
        },
        methods: {
            fetchData() {
                this.$get('/freighttemplate/get?template_id=' + this.template_id).then(response => {
                    this.template = response.result.template;
                });
            },
            saveData() {
                this.$post('/freighttemplate/save', {
                    template_id: this.template_id,
                    template: this.template
                }).then(response => {
                    this.$showToast('模板保存成功', () => this.$router.go(0));
                });
            },
            handleSubmit() {
                if (!this.template.template_name) {
                    this.$showToast('请填写模板名称');
                    return false;
                }
                this.saveData();
            }
        }
    }
</script>

<style scoped>

</style>
