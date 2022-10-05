<template>
    <div class="container">
        <div class="sysmessage-contaniner">
            <div class="sysmessage-icon">
                <span class="iconfont icon-check-circle-fill"></span>
            </div>
            <div class="sysmessage-tips" v-if="type">您已成功续费超级会员</div>
            <div class="sysmessage-tips" v-else>您已成功开通超级会员</div>
        </div>
        <div class="sysmessage-button">
            <van-button block type="danger" @click="$router.replace('/member')">查看详情</van-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MemberPaid",
        data() {
            return {
                type: 0
            }
        },
        mounted() {
            let {type} = this.$route.query;
            this.type = type;
        }
    }
</script>

<style scoped>

</style>
