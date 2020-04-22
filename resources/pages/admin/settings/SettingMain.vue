<template>
    <admin-frame>
        <header class="page-header">
            <div class="page-title">店铺设置</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <el-tabs>
                    <el-tab-pane label="基本设置">
                        <div class="tab-content">
                            <setting-basic :settings="settings"></setting-basic>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="注册设置">
                        <div class="tab-content">
                            <setting-register :settings="settings"></setting-register>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="附件设置">
                        <div class="tab-content">
                            <setting-attach :settings="settings"></setting-attach>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="水印设置">
                        <div class="tab-content">
                            <setting-water :settings="settings"></setting-water>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="微信设置">
                        <div class="tab-content">
                            <setting-wechat :settings="settings"></setting-wechat>
                        </div>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button type="primary" @click="submit">更新配置</el-button>
        </div>
    </admin-frame>
</template>

<script>
    import AdminFrame from "../common/AdminFrame";
    import SettingBasic from "./SettingBasic";
    import SettingRegister from "./SettingRegister";
    import SettingAttach from "./SettingAttach";
    import SettingWater from "./SettingWater";
    import SettingWechat from "./SettingWechat";

    export default {
        name: "SettingMain",
        components: {
            AdminFrame,
            SettingBasic,
            SettingRegister,
            SettingAttach,
            SettingWater,
            SettingWechat
        },
        data: function () {
            return {
                settings:{},
                tabStyle:{
                    'flex':'none',
                    'padding-left':'15px',
                    'padding-right':'15px'
                }
            }
        },
        created() {
            this.fetchAll();
        },
        methods:{
            submit:function () {
                this.$axios.post('/webapi/settings/update',{settings:this.settings}).then(response=>{
                    this.$showToast('配置更新成功');
                });
            },
            fetchAll:function () {
                this.$axios.get('/webapi/settings/getall',{settings:this.settings}).then(response=>{
                    this.settings = response.data.settings;
                });
            }
        }
    }
</script>

<style scoped>
.tab-content{
    margin-top: 10px;
    padding: 0 10px;
}
</style>
