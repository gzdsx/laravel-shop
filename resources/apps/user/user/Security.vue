<template>
    <div class="content-block">
        <div class="console-title">
            <h2>账户安全</h2>
        </div>
        <div>
            <table class="dsxui-formtable">
                <colgroup>
                    <col width="100">
                    <col width="200">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>用户名</td>
                    <td>{{user.username}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>账号ID</td>
                    <td>{{user.uid}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>手　机</td>
                    <td>
                        <p v-if="user.mobile">{{hidePhoneNumber(user.mobile)}}</p>
                        <p v-else>尚未绑定手机号</p>
                    </td>
                    <td>
                        <a @click="showMobile=true">绑定手机号</a>
                    </td>
                </tr>
                <tr>
                    <td>邮　箱</td>
                    <td>
                        <p v-if="user.email">{{hideEmail(user.email)}}</p>
                        <p v-else>尚未绑定邮箱</p>
                    </td>
                    <td><a @click="showEmail=true">更换邮箱</a></td>
                </tr>
                <tr>
                    <td>密　码</td>
                    <td>******</td>
                    <td><a @click="showPass=true">修改密码</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <el-dialog title="绑定手机号" :visible.sync="showMobile" width="500px" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w60">
                    <col class="w300">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>新手机号</td>
                    <td>
                        <el-input size="medium" v-model="mobile"></el-input>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w200" @click="handleSaveMobile">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
        <el-dialog title="绑定邮箱" :visible.sync="showEmail" width="500px" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w60">
                    <col class="w300">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>邮箱账号</td>
                    <td>
                        <el-input size="medium" v-model="email"></el-input>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w200" @click="handleSaveEmail">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
        <el-dialog title="修改密码" :visible.sync="showPass" width="500px" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w60">
                    <col class="w300">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>原密码</td>
                    <td>
                        <el-input size="medium" v-model="password"></el-input>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>新密码</td>
                    <td>
                        <el-input size="medium" v-model="newpassword"></el-input>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w200" @click="handleSavePassword">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "Security",
        data() {
            return {
                showMobile: false,
                showEmail: false,
                showPass: false,
                mobile: '',
                email: '',
                password: '',
                newpassword: ''
            }
        },
        computed: {
            user() {
                return this.$store.state.auth.userinfo;
            }
        },
        methods: {
            hidePhoneNumber: (phoneNumber) => {
                return phoneNumber.replace(/(\d{3})\d{4}(\d{4})/, '$1****$2');
            },
            hideEmail: (email) => {
                return email.replace(/([\w-]{0,3})(.*)@(.*)/, '$1****@$3');
            },
            handleSaveMobile() {
                if (!this.mobile) {
                    this.$showToast('请填写新手机号');
                    return false;
                }

                if (!this.$validator.isMobile(this.mobile)) {
                    this.$showToast('手机号输入有误');
                    return false;
                }

                if (this.mobile === user.mobile) {
                    this.$showToast('新手机号不能和原来一致');
                    return false;
                }

                this.$post('/security/mobile/update', {mobile: this.mobile}).then(response => {
                    if (response.result.errcode) {
                        this.$showToast(response.result.errmsg);
                    } else {
                        this.user.mobile = this.mobile;
                        this.showMobile = false;
                        this.$showToast('手机号码已更新');
                        this.resetData();
                    }
                });
            },
            handleSaveEmail() {
                if (!this.email) {
                    this.$showToast('请填写邮箱地址');
                    return false;
                }
                if (this.email === user.email) {
                    this.$showToast('新邮箱不能和原来一致');
                    return false;
                }

                this.$post('/security/email/update', {email: this.email}).then(response => {
                    if (response.result.errcode) {
                        this.$showToast(response.result.errmsg);
                    } else {
                        this.user.email = this.email;
                        this.showEmail = false;
                        this.$showToast('邮箱已更新');
                        this.resetData();
                    }
                });
            },
            handleSavePassword() {
                if (!this.password) {
                    this.$showToast('请填写原密码');
                    return false;
                }
                if (!this.newpassword) {
                    this.$showToast('请填写新密码');
                    return false;
                }

                this.$post('/security/password/update', {
                    password: this.password,
                    newpassword: this.newpassword
                }).then(response => {
                    if (response.result.errcode) {
                        this.$showToast(response.result.errmsg);
                    } else {
                        this.showPass = false;
                        this.$showToast('密码已更新');
                        this.resetData();
                    }
                });
            },
            resetData() {
                this.mobile = null;
                this.email = null;
                this.password = null;
                this.newpassword = null;
            }
        }
    }
</script>

<style scoped>

</style>
