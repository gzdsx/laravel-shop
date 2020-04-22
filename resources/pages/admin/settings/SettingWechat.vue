<template>
    <table class="dsxui-formtable">
        <tbody>
        <tr>
            <td class="cell-label" width="110">文章图片:</td>
            <td class="cell-input" width="320">
                <el-input size="medium" v-model="settings.wechat_subscribe_msg_img"></el-input>
            </td>
            <td class="cell-tips">关注公众号时自动回复图文消息配图</td>
        </tr>
        <tr>
            <td class="cell-label">文章标题:</td>
            <td class="cell-input">
                <el-input size="medium" v-model="settings.wechat_subscribe_msg_title"></el-input>
            </td>
            <td class="cell-tips">关注公众号时自动回复图文标题</td>
        </tr>
        <tr>
            <td class="cell-label">文字说明:</td>
            <td class="cell-input">
                <el-input type="textarea" rows="5" v-model="settings.wechat_subscribe_msg_text"></el-input>
            </td>
            <td class="cell-tips">关注公众号时自动回复文字说明</td>
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
</template>

<script>
    export default {
        name: "SettingWechat",
        props: {
            settings: Object
        }
    }
</script>

<style scoped>

</style>
