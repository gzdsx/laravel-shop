<template>
    <table class="dsxui-formtable">
        <tbody>
        <tr>
            <td width="110" class="cell-label">开启图片水印:</td>
            <td width="400" class="cell-input">
                <div class="input-group">
                    <el-radio label="1" v-model="settings.water_mark">是</el-radio>
                    <el-radio label="0" v-model="settings.water_mark">否</el-radio>
                </div>
            </td>
            <td class="cell-tips">是否启用图片水印</td>
        </tr>
        <tr>
            <td class="cell-label">水印类型:</td>
            <td class="cell-input">
                <div class="input-group">
                    <el-radio label="1" v-model="settings.water_type">图片水印</el-radio>
                    <el-radio label="0" v-model="settings.water_type">文字水印</el-radio>
                </div>
            </td>
            <td class="cell-tips"></td>
        </tr>
        <tr>
            <td class="cell-label">水印字体:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_font"></el-input>
            </td>
            <td class="cell-tips">字体相对于网站根目录路径</td>
        </tr>
        <tr>
            <td class="cell-label">水印图片:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_image"></el-input>
            </td>
            <td class="cell-tips">图片相对于网站根目录路径</td>
        </tr>
        <tr>
            <td class="cell-label">水印位置:</td>
            <td class="cell-input">
                <el-select class="w-100" v-model="settings.water_pos">
                    <el-option value="top-left" label="左上角"></el-option>
                    <el-option value="top-center" label="上居中"></el-option>
                    <el-option value="top-right" label="右上角"></el-option>
                    <el-option value="left" label="居左"></el-option>
                    <el-option value="center" label="居中"></el-option>
                    <el-option value="right" label="居右"></el-option>
                    <el-option value="bottom-left" label="左下角"></el-option>
                    <el-option value="bottom-center" label="下居中"></el-option>
                    <el-option value="bottom-right" label="右下角"></el-option>
                </el-select>
            </td>
            <td class="cell-tips"></td>
        </tr>
        <tr>
            <td class="cell-label">水印透明度:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_alpha"></el-input>
            </td>
            <td class="cell-tips">水印透明度,100为不透明</td>
        </tr>
        <tr>
            <td class="cell-label">水印文字:</td>
            <td class="cell-input">
                <el-input type="textarea" v-model="settings.water_text"></el-input>
            </td>
            <td class="cell-tips">水印文字，仅当设定为文字水印时有效</td>
        </tr>
        <tr>
            <td class="cell-label">水印颜色:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_color"></el-input>
            </td>
            <td class="cell-tips">水印文字颜色，仅当设定为文字水印时有效</td>
        </tr>
        <tr>
            <td class="cell-label">字体大小:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_size"></el-input>
            </td>
            <td class="cell-tips">水印文字字体大小，仅当设定为文字水印时有效</td>
        </tr>
        <tr>
            <td class="cell-label">水平偏移量:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_offset_x"></el-input>
            </td>
            <td class="cell-tips">水印水平位置偏移量，单位像素</td>
        </tr>
        <tr>
            <td class="cell-label">垂直偏移量:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_offset_y"></el-input>
            </td>
            <td class="cell-tips">水印垂直偏移量，单位像素</td>
        </tr>
        <tr>
            <td class="cell-label">旋转角度:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_angle"></el-input>
            </td>
            <td class="cell-tips">水印文字旋转角度</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "SettingsWater",
        props: {
            settings: Object
        }
    }
</script>

<style scoped>

</style>
