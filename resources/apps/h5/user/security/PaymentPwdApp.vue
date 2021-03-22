<template>
    <div>
        <van-cell-group>
            <van-field
                    v-model="password"
                    type="password"
                    label="支付密码"
                    placeholder="请输入6位数字密码"
                    size="large"
                    :maxlength="6"
                    class="van-field-large"
            />
            <van-field
                    v-model="password_confirm"
                    type="password"
                    label="确认密码"
                    placeholder="请再次输入支付密码"
                    size="large"
                    :maxlength="6"
                    class="van-field-large"
            />
        </van-cell-group>
        <div style="margin: 30px 16px;">
            <van-button block type="info" :disabled="disabled" @click="onSubmit">
                提交
            </van-button>
        </div>
    </div>
</template>

<script>

    export default {
        name: "PaymentPwdApp",
        data() {
            return {
                password: '',
                password_confirm: ''
            }
        },
        computed: {
            disabled() {
                return !(this.password.length === 6 && this.password_confirm === this.password);
            }
        },
        mounted() {

        },
        methods: {
            onSubmit() {
                const password = this.password;
                const password_confirm = this.password_confirm;

                if (!/^.{6,20}$/.test(password)) {
                    this.$toast.fail('密码输入不正确');
                    return false;
                }

                if (!password_confirm) {
                    this.$toast.fail('请再次输入支付密码');
                    return false;
                }

                if (password !== password_confirm) {
                    this.$toast.fail('两次密码输入不一致');
                    return false;
                }

                this.$post('/security/paymentpwd/update', {password, password_confirm}).then(response => {
                    this.$toast.success({
                        message: '支付密码设置成功',
                        onClose: function () {
                            window.history.back();
                        }
                    })
                });
            }
        }
    }
</script>

<style scoped>

</style>
