<template>
    <div class="content-block">
        <div class="wellcome-div">
            <div class="txt">{{userinfo.username}}, 欢迎你!</div>
        </div>
        <div class="mcenter-content-div">
            <div class="flex-row" style="height: 130px;">
                <div class="headimg">
                    <div class="avatar">
                        <img :src="userinfo.avatar" alt="">
                        <div class="a-setting">
                            <router-link to="/userinfo">设置头像</router-link>
                        </div>
                    </div>
                </div>
                <div class="user-account">
                    <div class="row">
                        <div class="item">账户余额：<i>{{account.balance}}</i></div>
                        <div class="item">可用积分：<i>{{account.points}}</i></div>
                        <div class="item">账户状态：<i>正常</i></div>
                    </div>
                    <div class="row">
                        <div class="item">
                            <router-link to="/userinfo"><span class="iconfont icon-my"></span>修改个人资料</router-link>
                        </div>
                        <div class="item"><span class="iconfont icon-mobile"></span>手机已绑定</div>
                        <div class="item"><span class="iconfont icon-mail"></span>邮箱已绑定</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="coord"></div>
        <div class="mcenter-content-div">
            <div class="console-title"><strong>每日任务</strong></div>
        </div>

        <div class="mcenter-content-div">
            <div class="console-title"><strong>邀请好友</strong></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                account: {}
            }
        },
        computed: {
            userinfo() {
                return this.$store.state.auth.userinfo;
            }
        },
        mounted() {
            this.$get('/account/get').then(response => {
                this.account = response.result.account;
            });
        }
    }
</script>

<style scoped>

</style>
