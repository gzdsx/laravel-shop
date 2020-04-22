<template>
    <table class="dsxui-formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td width="110" class="cell-label">开启图片水印:</td>
            <td width="360" class="cell-input">
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
            <td class="cell-label">水印位置:</td>
            <td class="cell-input">
                <el-select class="w-100" v-model="settings.water_pos">
                    <el-option value="1" label="左上角"></el-option>
                    <el-option value="2" label="上居中"></el-option>
                    <el-option value="3" label="右上角"></el-option>
                    <el-option value="4" label="左居中"></el-option>
                    <el-option value="5" label="居中"></el-option>
                    <el-option value="6" label="右居中"></el-option>
                    <el-option value="7" label="左下角"></el-option>
                    <el-option value="8" label="下居中"></el-option>
                    <el-option value="9" label="右下角"></el-option>
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
            <td class="cell-label">位置偏移量:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.water_offset"></el-input>
            </td>
            <td class="cell-tips">水印位置偏移量，单位像素</td>
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
        name: "SettingWater",
        props:{
            settings:Object
        }
    }
</script>

<style scoped>

</style>
