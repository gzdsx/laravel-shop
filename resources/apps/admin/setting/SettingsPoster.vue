<template>
    <div>
        <table class="dsxui-formtable">
            <tbody>
            <tr>
                <td class="cell-label" width="110">海报背景:</td>
                <td class="cell-input" width="400">
                    <div @click="showImagePicker('poster_bg')">
                        <el-image :src="settings.poster_bg" fit="contain" class="img-80"
                                  v-if="settings.poster_bg"></el-image>
                        <div class="img-placeholder img-80" v-else></div>
                    </div>
                </td>
                <td class="cell-tips">推广海报背景图片，尺寸:750x1334</td>
            </tr>
            <tr>
                <td class="cell-label">二维码位置:</td>
                <td class="cell-input">
                    <el-select v-model="settings.poster_code_pos" class="w-100">
                        <el-option value="top-left" label="顶部居左"></el-option>
                        <el-option value="top-center" label="顶部居中"></el-option>
                        <el-option value="top-center" label="顶部居右"></el-option>
                        <el-option value="center" label="居中"></el-option>
                        <el-option value="bottom-left" label="底部居左"></el-option>
                        <el-option value="bottom-center" label="底部居中"></el-option>
                        <el-option value="bottom-right" label="底部居右"></el-option>
                    </el-select>
                </td>
                <td class="cell-tips">二维码显示位置</td>
            </tr>
            <tr>
                <td class="cell-label">二维码横向偏移:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.poster_code_x"></el-input>
                </td>
                <td class="cell-tips">二维码位置x轴偏移量</td>
            </tr>
            <tr>
                <td class="cell-label">二维码纵向偏移:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.poster_code_y"></el-input>
                </td>
                <td class="cell-tips">二维码位置y轴偏移量</td>
            </tr>
            <tr>
                <td class="cell-label">二维码尺寸:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.poster_code_size"></el-input>
                </td>
                <td class="cell-tips">海报二维码尺寸</td>
            </tr>
            <tr>
                <td class="cell-label">海报说明文字:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.poster_text"></el-input>
                </td>
                <td class="cell-tips">海报二维码底部说明文字</td>
            </tr>
            <tr>
                <td class="cell-label">文字颜色:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.poster_font_color"></el-input>
                </td>
                <td class="cell-tips">海报文字颜色</td>
            </tr>
            </tbody>
        </table>
        <image-picker v-model="showPicker" @confirm="onChooseImage"/>
    </div>
</template>

<script>
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "SettingsPoster",
        components: {
            ImagePicker,
        },
        props: {
            settings: Object
        },
        data() {
            return {
                showPicker: false,
                key: ''
            }
        },
        methods: {
            onChooseImage(data) {
                this.settings[this.key] = data.image;
            },
            showImagePicker(key) {
                this.key = key;
                this.showPicker = true;
            }
        }
    }
</script>

<style scoped>

</style>
