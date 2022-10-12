<template>
    <div>
        <header class="page-header">
            <div class="page-title">设置</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <el-tabs>
                    <el-tab-pane label="基本设置">
                        <div class="tab-content">
                            <settings-basic :settings="settings"></settings-basic>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="注册设置">
                        <div class="tab-content">
                            <settings-register :settings="settings"></settings-register>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="附件设置">
                        <div class="tab-content">
                            <settings-attach :settings="settings"></settings-attach>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="水印设置">
                        <div class="tab-content">
                            <settings-water :settings="settings"></settings-water>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="微信公众号">
                        <div class="tab-content">
                            <settings-wechat :settings="settings"></settings-wechat>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="推广海报">
                        <div class="tab-content">
                            <settings-poster :settings="settings"></settings-poster>
                        </div>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
        <div class="h40"></div>
        <div class="edit-bottom">
            <el-button type="primary" @click="handleSubmit">更新配置</el-button>
        </div>
    </div>
</template>

<script>
    import SettingsBasic from "./SettingsBasic";
    import SettingsRegister from "./SettingsRegister";
    import SettingsAttach from "./SettingsAttach";
    import SettingsWater from "./SettingsWater";
    import SettingsWechat from "./SettingsWechat";
    import SettingsPoster from "./SettingsPoster";

    export default {
        name: "SettingsMain",
        components: {
            SettingsPoster,
            SettingsWechat,
            SettingsWater,
            SettingsAttach,
            SettingsRegister,
            SettingsBasic
        },
        data() {
            return {
                settings: {},
                tabStyle: {
                    'flex': 'none',
                    'padding-left': '15px',
                    'padding-right': '15px'
                }
            }
        },
        methods: {
            fetchSettings() {
                this.$get('/common/setting.settings').then(response => {
                    this.settings = response.result;
                });
            },
            handleSubmit() {
                let {settings} = this;
                this.$post('/common/setting.update', {settings}).then(response => {
                    this.$showToast('配置更新成功');
                });
            },
        },
        created() {
            this.fetchSettings();
        },
    }
</script>

<style scoped>
    .tab-content {
        margin-top: 10px;
        padding: 0 10px;
    }
</style>
