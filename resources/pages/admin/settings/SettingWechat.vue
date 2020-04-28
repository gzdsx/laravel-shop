<template>
    <div>
        <table class="dsxui-formtable">
            <tbody>
            <tr>
                <td class="cell-label" width="110">消息配图:</td>
                <td class="cell-input" width="320">
                    <div @click="showPicker=true">
                        <el-image :src="settings.wechat_subscribe_msg_img" class="img-80" v-if="settings.wechat_subscribe_msg_img"></el-image>
                        <div class="img-placeholder img-80" v-else></div>
                    </div>
                </td>
                <td class="cell-tips">关注公众号时自动回复图文消息配图</td>
            </tr>
            <tr>
                <td class="cell-label">消息标题:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.wechat_subscribe_msg_title"></el-input>
                </td>
                <td class="cell-tips">关注公众号时自动回复图文消息标题</td>
            </tr>
            <tr>
                <td class="cell-label">文字说明:</td>
                <td class="cell-input">
                    <el-input type="textarea" rows="5" v-model="settings.wechat_subscribe_msg_text"></el-input>
                </td>
                <td class="cell-tips">关注公众号时自动回复图文消息文字说明</td>
            </tr>
            <tr>
                <td class="cell-label">文章链接:</td>
                <td class="cell-input">
                    <el-input size="medium" v-model="settings.wechat_subscribe_msg_url"></el-input>
                </td>
                <td class="cell-tips">关注公众号时自动回复图文链接</td>
            </tr>
            </tbody>
        </table>
        <image-picker v-model="showPicker" @confirm="handlePickedImage"></image-picker>
    </div>
</template>

<script>
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "SettingWechat",
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
                this.settings.wechat_subscribe_msg_img = data.image;
            }
        }
    }
</script>

<style scoped>

</style>
