<template>
    <div>
        <van-cell-group>
            <van-field
                    v-model="email"
                    type="email"
                    placeholder="请输入邮箱"
                    size="large"
                    class="van-field-large"
            >
            </van-field>
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
        name: "BindEmail",
        data() {
            return {
                email: '',
            }
        },
        computed: {
            disabled() {
                return !this.$validator.isEmail(this.email);
            },
        },
        mounted() {

        },
        methods: {
            onSubmit() {
                const email = this.email;
                if (!this.$validator.isEmail(email)) {
                    this.$toast.fail('邮箱输入不正确');
                    return false;
                }

                this.$post('/security/email/update', {email}).then(response => {
                    this.$toast.success({
                        message: '邮箱绑定成功',
                        onClose: function () {
                            window.history.back();
                        }
                    })
                }).catch(reason => {
                    this.$toast.fail(reason.data.errmsg);
                });
            },
        }
    }
</script>

<style scoped>

</style>
