<template>
    <div class="transfer-fill">
        <div class="transfer-user">
            <div class="avatar">
                <img :src="user.avatar"/>
            </div>
            <div class="username">转给{{user.username}}</div>
        </div>
        <div class="transfer-title">转账金额</div>
        <div class="transfer-amount">
            <span>￥</span>
            <input class="input" type="number" v-model="amount">
        </div>
        <div class="transfer-balance">可用余额:{{account.balance}}</div>
        <label>
            <input type="text" class="transfer-remark" v-model="remark" placeholder="添加备注（50字以内）">
        </label>
        <div class="transfer-button">
            <van-button type="info" block @click="showPassword" class="h50">确认转账</van-button>
        </div>
        <van-popup class="payment-popup" :close-on-click-overlay="false" closeable v-model="showPopup">
            <div class="payment-popup-container">
                <div class="payment-popup-header">请输入支付密码</div>
                <div class="payment-popup-desc">转账给{{user.username}}</div>
                <div class="payment-popup-amount">
                    <i>￥</i>
                    <span>{{amount}}</span>
                </div>
                <div class="payment-popup-password">
                    <van-password-input
                            :value="password"
                            :focused="showKeyboard"
                            @focus="showKeyboard = true"
                            info="密码为6位数字，可在账户安全里设置"
                    />
                </div>
            </div>
        </van-popup>
        <van-number-keyboard
                v-model="password"
                :show="showKeyboard"
                :mask="false"
                @blur="showKeyboard = false"
                :z-index="99999"
        />
    </div>
</template>

<script>
    export default {
        name: "TransferFill",
        data() {
            return {
                amount: '',
                password: '',
                remark: '',
                user: {},
                account: {},
                submiting: false,
                showKeyboard: false,
                showPopup: false
            }
        },
        computed: {
            disabled() {
                return !/^[0-9]+(.[0-9]{1,2})?$/.test(this.amount);
            }
        },
        mounted() {
            this.$get('/user/account').then(response => {
                this.account = response.result.account;
            });

            let {uid} = this.$route.query;
            this.$get('/user/transfer.find', {uid}).then(response => {
                this.user = response.result.user;
            });
        },
        watch: {
            password(val) {
                if (val.length === 6) {
                    this.submit();
                }
            }
        },
        methods: {
            showPassword() {
                const amount = parseFloat(this.amount);
                if (!/^[0-9]+(.[0-9]{1,2})?$/.test(amount)) {
                    this.$toast.fail('请输入转账金额');
                    return false;
                }

                if (amount < 1) {
                    this.$toast.fail('转账金额不能小于1元');
                    return false;
                }

                if (amount > parseFloat(this.account.balance)) {
                    this.$toast.fail('转账金额不能大于账户余额');
                    return false;
                }

                this.showPopup = true;
                this.showKeyboard = true;
            },
            submit() {
                const uid = this.user.uid;
                const amount = this.amount;
                const remark = this.remark;
                const password = this.password;

                if (this.submiting) {
                    return false
                } else {
                    this.submiting = true;
                }

                this.$post('/user/account.transfer', {
                    uid,
                    amount,
                    remark,
                    password
                }).then(response => {
                    this.showPopup = false;
                    this.showKeyboard = false;
                    this.$toast.success({
                        message:'转账成功',
                        onClose:()=>{
                            this.$router.go(-1);
                        }
                    })
                }).catch(reason => {
                    this.$toast.fail(reason.errMsg);
                    this.password = '';
                    this.submiting = false;
                });
            },
        }
    }
</script>

<style scoped>

</style>
