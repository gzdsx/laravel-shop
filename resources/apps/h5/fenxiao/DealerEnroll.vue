<template>
    <div class="dealer-enroll">
        <div class="dealer-head">
            <div class="dealer-user">
                <div><img :src="userInfo.avatar" class="avatar" alt=""/></div>
                <div class="username">{{userInfo.username}}</div>
            </div>
            <div class="dealer-action">
                <div class="dealer-tips">成为经销商，邀请好友一起赚钱</div>
                <van-button type="danger" class="w200" @click="onEnroll">申请成为经销商</van-button>
            </div>
        </div>

        <div class="dealer-body">
            <div class="dealer-privilege">
                <div class="dealer-privilege-header">
                    <div class="title">经销商特权</div>
                </div>
                <div class="dealer-privilege-body">
                    <img src="/images/app/member/vip_privilege.png" alt=""/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DealerEnroll",
        data() {
            return {}
        },
        computed: {
            userInfo() {
                return this.$store.state.userInfo;
            }
        },
        methods: {
            onEnroll() {
                this.$post('/user/dealer.pending.create').then(response => {
                    this.$toast('您的申请已提交，请等待管理员审核');
                });
            }
        },
        mounted() {

        },
    }
</script>

<style scoped>
    .van-cell {
        line-height: 1.2;
        padding-left: 0;
    }
</style>
