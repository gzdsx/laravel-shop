<template>
    <table class="dsxui-formtable">
        <tbody>
        <tr>
            <td width="110" class="cell-label">允许上传的文件类型:</td>
            <td width="400" class="cell-input">
                <el-input type="text" v-model="settings.file_allow_types"></el-input>
            </td>
            <td class="cell-tips">填写文件扩展名，多个名称间请用半角逗号 "," 隔开</td>
        </tr>
        <tr>
            <td class="cell-label">允许上传的文件最大限制:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.file_max_size"></el-input>
            </td>
            <td class="cell-tips">允许上传的文件体积最大值，单位MB</td>
        </tr>
        <tr>
            <td class="cell-label">允许上传的图片类型:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_allow_types"></el-input>
            </td>
            <td class="cell-tips">填写文件扩展名，多个名称间请用半角逗号 "," 隔开</td>
        </tr>
        <tr>
            <td class="cell-label">允许上传的图片最大限制:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_max_size"></el-input>
            </td>
            <td class="cell-tips">允许上传的文件体积最大值，单位MB</td>
        </tr>
        <tr>
            <td class="cell-label">图片缩略图宽:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_thumb_width"></el-input>
            </td>
            <td class="cell-tips">图片缩略图宽度，单位像素</td>
        </tr>
        <tr>
            <td class="cell-label">图片缩略图高:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_thumb_height"></el-input>
            </td>
            <td class="cell-tips">图片缩略图高度，单位像素</td>
        </tr>
        <tr>
            <td class="cell-label">图片最大宽度:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_max_width"></el-input>
            </td>
            <td class="cell-tips">单位像素，图片宽度超过设定值将自动压缩，不限请填0</td>
        </tr>
        <tr>
            <td class="cell-label">图片最大高度:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.image_max_height"></el-input>
            </td>
            <td class="cell-tips">单位像素，图片高度超过设定值将自动压缩，不限请填0</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "SettingsAttach",
        props: {
            settings: Object
        }
    }
</script>

<style scoped>

</style>
