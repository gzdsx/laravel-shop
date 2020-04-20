<template>
    <van-form @submit="onSubmit">
        <van-field
                v-model="password"
                type="password"
                name="password"
                label="登录密码"
                placeholder="请输入登录密码"
                :rules="[{ required: true, message: '请输入登录密码' }]"
                size="large"
        />
        <van-field
                v-model="password_confirm"
                type="password"
                name="password_confirm"
                label="确认密码"
                placeholder="请再次输入登录密码"
                :rules="[{ required: true, message: '请再次输入登录密码' }]"
                size="large"
        />
        <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
                提交
            </van-button>
        </div>
    </van-form>
</template>

<script>

    export default {
        name: "Security",
        data: function () {
            return {
                password: '',
                password_confirm: ''
            }
        },
        methods: {
            onSubmit: function (c) {
                const {password, password_confirm} = c;

                if (!/^.{6,20}$/.test(password)) {
                    this.$toast.fail('密码输入不合法');
                    return false;
                }

                if (password !== password_confirm) {
                    this.$toast.fail('两次密码输入不一致');
                    return false;
                }

                this.$axios.post('/h5/security/password', {password}).then(response => {
                    this.$toast.success({
                        message: '密码设置成功',
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
