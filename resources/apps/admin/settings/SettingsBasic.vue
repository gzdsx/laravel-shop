<template>
    <div>
        <table class="dsxui-formtable">
            <tbody>
            <tr>
                <td class="cell-label" width="110">LOGO:</td>
                <td class="cell-input" width="400">
                    <div class="w120" @click="showPicker=true">
                        <el-image :src="settings.logo" class="w120" fit="contain" v-if="settings.logo"></el-image>
                        <div class="img-placeholder img-120" v-else></div>
                    </div>
                </td>
                <td class="cell-tips">网站LOGO图片</td>
            </tr>
            <tr>
                <td class="cell-label">网站名称:</td>
                <td class="cell-input">
                    <el-input type="text" v-model="settings.sitename"/>
                </td>
                <td class="cell-tips">系统名称，将显示在导航条和标题中</td>
            </tr>
            <tr>
                <td class="cell-label">关键字:</td>
                <td class="cell-input">
                    <el-input type="text" v-model="settings.keywords"/>
                </td>
                <td class="cell-tips">Keywords 项出现在页面头部的 Meta 标签中，用于记录本页面的关键字，多个关键字间请用半角逗号 "," 隔开</td>
            </tr>
            <tr>
                <td class="cell-label">网站描述:</td>
                <td class="cell-input">
                    <el-input type="textarea" rows="5" v-model="settings.description"></el-input>
                </td>
                <td class="cell-tips">Description 出现在页面头部的 Meta 标签中，用于记录本页面的概要与描述</td>
            </tr>
            <tr>
                <td class="cell-label">备案信息:</td>
                <td class="cell-input">
                    <el-input type="text" v-model="settings.icp"></el-input>
                </td>
                <td class="cell-tips">页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的授权码，它将显示在页面底部，如果没有请留空</td>
            </tr>
            <tr>
                <td class="cell-label">版权信息:</td>
                <td class="cell-input">
                    <el-input type="text" v-model="settings.copyright"></el-input>
                </td>
                <td class="cell-tips">网站的版权信息，将显示在页面底部</td>
            </tr>
            <tr>
                <td class="cell-label">统计代码:</td>
                <td class="cell-input">
                    <el-input type="textarea" rows="5" v-model="settings.statcode"></el-input>
                </td>
                <td class="cell-tips">用于统计网站访问情况的第三方统计代码，通常为JS代码</td>
            </tr>
            <tr>
                <td class="cell-label">关闭网站:</td>
                <td class="cell-input">
                    <div class="input-group">
                        <el-radio label="1" v-model="settings.sysclosed">是</el-radio>
                        <el-radio label="0" v-model="settings.sysclosed">否</el-radio>
                    </div>
                </td>
                <td class="cell-tips">暂时将网站关闭，其他人无法访问，但不影响管理员访问</td>
            </tr>
            <tr>
                <td class="cell-label">关闭原因:</td>
                <td class="cell-input">
                    <el-input type="textarea" rows="5" v-model="settings.sysclosedreason"></el-input>
                </td>
                <td class="cell-tips">网站关闭时出现的提示信息</td>
            </tr>
            </tbody>
        </table>
        <image-picker v-model="showPicker" @confirm="handlePickedImage"></image-picker>
    </div>
</template>

<script>
    import ImagePicker from "../../lib/ImagePicker";
    export default {
        name: "SettingsBasic",
        components: {
            ImagePicker,
        },
        props: {
            settings: Object
        },
        data: function () {
            return {
                showPicker: false
            }
        },
        methods: {
            handlePickedImage(data) {
                this.settings.logo = data.image;
            }
        }
    }
</script>

<style scoped>

</style>
