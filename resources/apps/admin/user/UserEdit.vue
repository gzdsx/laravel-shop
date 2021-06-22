<template>
    <div>
        <header class="page-header">
            <div class="flex">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>用户管理</el-breadcrumb-item>
                    <el-breadcrumb-item>编辑用户</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div>
                <router-link to="/user/list">
                    <el-button type="primary" size="small">返回列表</el-button>
                </router-link>
            </div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <table class="dsxui-formtable">
                    <colgroup>
                        <col class="w80">
                        <col class="w300">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="cell-label">用户名</td>
                        <td>
                            <el-input size="medium" v-model="user.username"></el-input>
                        </td>
                        <td class="cell-tips">可包含中文，字母和下划线符号</td>
                    </tr>
                    <tr>
                        <td class="cell-label">登录密码</td>
                        <td>
                            <el-input size="medium" type="password" v-model="user.password"></el-input>
                        </td>
                        <td class="cell-tips"><p v-if="uid>0">不需要修改时请留空</p></td>
                    </tr>
                    <tr>
                        <td class="cell-label">手机号码</td>
                        <td>
                            <el-input size="medium" v-model="user.mobile"></el-input>
                        </td>
                        <td class="cell-tips">11位号码，可用于登录，不可与他人重复</td>
                    </tr>
                    <tr>
                        <td class="cell-label">登录邮箱</td>
                        <td>
                            <el-input size="medium" v-model="user.email"></el-input>
                        </td>
                        <td class="cell-tips">可用于登录，不可与他人重复</td>
                    </tr>
                    <tr>
                        <td class="cell-label">用户分组</td>
                        <td>
                            <el-select size="medium" class="w300" v-model="user.gid">
                                <el-option
                                        v-for="(group,index) in groups"
                                        :label="group.title"
                                        :value="group.gid"
                                        :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="cell-label">管理权限</td>
                        <td>
                            <el-radio :label="1" v-model="user.admincp">是</el-radio>
                            <el-radio :label="0" v-model="user.admincp">否</el-radio>
                        </td>
                        <td class="cell-tips">是否允许此用户登录后台</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <el-button size="medium" type="primary" class="w200" @click="handleSave">提交</el-button>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserEdit",
        data () {
            return {
                uid: 0,
                user: {},
                groups: []
            }
        },
        mounted() {
            this.fetchGroups();
            const uid = this.$route.query.uid;
            if (uid) {
                this.uid = uid;
                this.fetchData();
            }
        },
        methods: {
            fetchGroups() {
                this.$get('/user/group/getall').then(response => {
                    this.groups = response.result.items;
                });
            },
            fetchData() {
                this.$get('/user/get', {uid: this.uid}).then(response => {
                    this.user = response.result.user;
                });
            },
            handleSave() {
                if (!this.user.username) {
                    this.$showToast('请填写用户名');
                    return false;
                }

                this.$post('/user/save', {
                    uid: this.uid,
                    user: this.user
                }).then(response => {
                    this.$showToast('用户信息保存成功', this.$router.go(0));
                }).catch(reason => {
                    if (reason.data) {
                        this.$showToast(reason.data.errmsg);
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
