<template>
    <table class="dsxui-formtable">
        <tbody>
        <tr>
            <td width="110" class="cell-label">开放用户注册:</td>
            <td width="400" class="cell-input">
                <div class="input-group">
                    <label><el-radio label="1" v-model="settings.regallowed">是</el-radio></label>
                    <label><el-radio label="0" v-model="settings.regallowed">否</el-radio> </label>
                </div>
            </td>
            <td class="cell-tips">设置是否允许游客注册成为网站会员。</td>
        </tr>
        <tr>
            <td class="cell-label">新用户注册验证:</td>
            <td class="cell-input">
                <el-select class="w-100" v-model="settings.regverify">
                    <el-option value="0" label="无"></el-option>
                    <el-option value="1" label="Email验证"></el-option>
                    <el-option value="2" label="人工审核"></el-option>
                </el-select>
            </td>
            <td class="cell-tips">
                选择“无”用户可直接注册成功；选择“Email 验证”将向用户注册 Email 发送一封验证邮件以确认邮箱的有效性；
                选择“人工审核”将由管理员人工逐个确定是否允许新用户注册
            </td>
        </tr>
        <tr>
            <td class="cell-label">发送欢迎信息:</td>
            <td class="cell-input">
                <div class="input-group">
                    <el-radio label="0" v-model="settings.send_wellcome_msg">不发送</el-radio>
                    <el-radio label="1" v-model="settings.send_wellcome_msg">发送欢迎信息</el-radio>
                </div>
            </td>
            <td class="cell-tips">可选择是否自动向新注册用户发送一条欢迎信息</td>
        </tr>
        <tr>
            <td class="cell-label">欢迎信息标题:</td>
            <td class="cell-input">
                <el-input type="text" v-model="settings.wellcome_msg_title"></el-input>
            </td>
            <td class="cell-tips">新用户注册欢迎信息标题</td>
        </tr>
        <tr>
            <td class="cell-label">欢迎信息内容:</td>
            <td class="cell-input">
                <el-input type="textarea" rows="5" v-model="settings.wellcome_msg_content"></el-input>
            </td>
            <td class="cell-tips">新用户注册欢迎信息内容</td>
        </tr>
        <tr>
            <td class="cell-label">显示许可协议:</td>
            <td class="cell-input">
                <div class="input-group">
                    <el-radio label="1" v-model="settings.sysrules"> 是</el-radio>
                    <el-radio label="0" v-model="settings.sysrules">否</el-radio>
                </div>
            </td>
            <td class="cell-tips">新用户注册时显示许可协议</td>
        </tr>
        <tr>
            <td class="cell-label">许可协议内容:</td>
            <td class="cell-input">
                <el-input type="textarea" rows="10" v-model="settings.sysrulestxt"></el-input>
            </td>
            <td class="cell-tips">注册许可协议的详细内容</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "SettingsRegister",
        props:{
            settings:Object
        }
    }
</script>

<style scoped>

</style>
