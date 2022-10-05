<template>
    <div v-if="loading"></div>
    <div v-else>
        <div class="superior" v-if="superior">
            <h1>您已绑定以下联系人</h1>
            <p>{{superior.username}}</p>
            <p>{{superior.phone}}</p>
        </div>
        <div v-else>
            <van-cell-group>
                <van-field
                        v-model="username"
                        label="联系人姓名"
                        label-width="100px"
                        type="text"
                        placeholder="请输入姓名"
                        size="large"
                        class="van-field-large"
                >
                </van-field>
                <van-field
                        v-model="phone"
                        label="联系人手机"
                        label-width="100px"
                        type="number"
                        placeholder="请输入手机号"
                        size="large"
                        class="van-field-large"
                >
                </van-field>
            </van-cell-group>
            <div class="van-cell-button-container">
                <van-button block type="warning" :disabled="disabled" @click="onSubmit">
                    确认
                </van-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BindSuperior",
        data() {
            return {
                username: '',
                phone: '',
                superior: null,
                loading: true
            }
        },
        computed: {
            disabled() {
                return !this.$validator.isUserName(this.username) || !this.$validator.isMobile(this.phone);
            }
        },
        mounted() {
            this.setBackgroundColor('#fff');
            this.$get('/user/superior.info').then(response => {
                let {superior} = response.result;
                this.superior = superior;
                this.loading = false;
            }).catch(reason => {
                this.loading = false;
            });
        },
        methods: {
            onSubmit() {
                let {username, phone} = this;
                this.$post('/user/superior.bind', {username, phone}).then(response => {
                    this.$toast.success({
                        message: '联系人绑定成功',
                        onClose: () => {
                            this.$router.go(0);
                        }
                    });
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                });
            }
        }
    }
</script>

<style scoped>

</style>
