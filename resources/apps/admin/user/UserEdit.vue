<template>
    <div>
        <header class="page-header">
            <div class="page-title">编辑用户</div>
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
                        <td class="cell-label">头像</td>
                        <td>
                            <div class="img-60" @click="showImagePicker=true">
                                <img :src="user.avatar" class="img-60" v-if="user.avatar"/>
                                <div class="img-60 img-placeholder" v-else></div>
                            </div>
                        </td>
                        <td class="cell-tips">支持JPG/PNG/JPEG格式</td>
                    </tr>
                    <tr>
                        <td class="cell-label">昵称</td>
                        <td>
                            <el-input size="medium" v-model="user.nickname"></el-input>
                        </td>
                        <td class="cell-tips">可包含中文，字母和下划线符号</td>
                    </tr>
                    <tr>
                        <td class="cell-label">登录密码</td>
                        <td>
                            <el-input size="medium" type="password" v-model="user.password"></el-input>
                        </td>
                        <td class="cell-tips"><p v-if="user.uid">不需要修改时请留空</p></td>
                    </tr>
                    <tr>
                        <td class="cell-label">手机号码</td>
                        <td>
                            <el-input size="medium" v-model="user.phone"></el-input>
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
                                        v-for="(group,index) in groupList"
                                        :label="group.name"
                                        :value="group.gid"
                                        :key="index"
                                ></el-option>
                            </el-select>
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td>
                            <el-button size="medium" type="primary" class="w200" @click="onSubmit">提交</el-button>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <image-picker v-model="showImagePicker" :params="{width:500,fit:true}" @confirm="onChooseImage"/>
    </div>
</template>

<script>
    export default {
        name: "UserEdit",
        data() {
            return {
                user: {},
                groupList: [],
                memberList: [],
                showImagePicker: false
            }
        },
        methods: {
            fetchData() {
                let {uid} = this.$route.params;
                if (!uid) return;
                this.$get('/user/user.getInfo', {uid}).then(response => {
                    this.user = response.result;
                });
            },
            fetchGroupList() {
                this.$get('/user/group.getList').then(response => {
                    this.groupList = response.result.items;
                });
            },
            onSubmit() {
                let {user} = this;
                if (!user.nickname) {
                    this.$showToast('请填写昵称');
                    return false;
                }

                this.$post('/user/user.save', user).then(() => {
                    this.$showToast('用户信息保存成功', this.$router.go(0));
                }).catch(reason => {
                    this.$showToast(reason.errMsg);
                });
            },
            onChooseImage(data) {
                this.user.avatar = data.image;
            }
        },
        mounted() {
            this.fetchData();
            this.fetchGroupList();
        },
    }
</script>

<style scoped>

</style>
