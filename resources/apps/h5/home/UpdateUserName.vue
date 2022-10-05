<template>
    <div>
        <van-cell-group>
            <van-field
                    v-model="username"
                    type="text"
                    placeholder="请输入姓名"
                    size="large"
                    class="van-field-large"
            >
            </van-field>
        </van-cell-group>
        <div style="margin: 30px 16px;">
            <van-button block type="warning" :disabled="disabled" @click="onSubmit">
                提交
            </van-button>
        </div>
    </div>
</template>

<script>
    import {USERDIDCHANGE} from "../vuex/types";

    export default {
        name: "UpdateUserName",
        data() {
            return {
                username: ''
            }
        },
        computed: {
            disabled() {
                return !this.$validator.isUserName(this.username);
            }
        },
        mounted() {
            this.setBackgroundColor('#fff');
            this.username = this.$store.state.userInfo.username;
        },
        methods: {
            onSubmit() {
                const {username} = this;
                if (!this.$validator.isUserName(username)) {
                    this.$toast.fail('姓名输入不正确');
                    return false;
                }

                this.$post('/user/username.update', {username}).then(response => {
                    let {userInfo} = this.$store.state;
                    userInfo.username = username;
                    this.$store.commit(USERDIDCHANGE, userInfo);
                    this.$toast.success({
                        message: '姓名修改成功',
                        onClose: () => {
                            this.$router.go(-1);
                        }
                    });
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            },
        }
    }
</script>

<style scoped>

</style>
