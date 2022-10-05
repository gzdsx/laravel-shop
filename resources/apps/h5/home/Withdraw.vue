<template>
    <div class="withdraw">
        <div class="withdraw-content">
            <div class="withdraw-title">提现积分</div>
            <div class="withdraw-amount">
                <span>￥</span>
                <input class="input" type="number" v-model="amount">
            </div>
            <div class="withdraw-balance">
                可用积分{{account.balance}}，提现额度必须为100的倍数，提现手续费<b style="color:blue">20%</b>，提现手续费将存入备用金账户，可用于购物消费;
                <b style="color:blue">（建议使用积分互转功能变现，零手续费，需要帮助请联系推荐人或客服。）</b>。
            </div>
        </div>
        <div class="withdraw-button">
            <van-button type="info" block @click="showPassword" class="h50">确定</van-button>
        </div>
        <van-popup class="payment-popup" :close-on-click-overlay="false" closeable v-model="showPopup">
            <div class="payment-popup-container">
                <div class="payment-popup-header">请输入支付密码</div>
                <div class="payment-popup-desc">零钱提现</div>
                <div class="payment-popup-amount">
                    <i>￥</i>
                    <span>{{amount}}</span>
                </div>
                <div class="payment-popup-cell">
                    <div class="title">服务费</div>
                    <span>￥{{serviceFee}}</span>
                </div>
                <div class="payment-popup-cell">
                    <div class="title">费率</div>
                    <span>5%</span>
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
        name: "Withdraw",
        data() {
            return {
                amount: '',
                password: '',
                account: {},
                submiting: false,
                showKeyboard: false,
                showPopup: false
            }
        },
        computed: {
            disabled() {
                return !/^[0-9]+(.[0-9]{1,2})?$/.test(this.amount);
            },
            serviceFee() {
                if (/^[0-9]+(.[0-9]{1,2})?$/.test(this.amount)) {
                    return (this.amount * 0.05).toFixed(2);
                } else {
                    return '0.00';
                }
            }
        },
        watch: {
            password(val) {
                if (val.length === 6) {
                    this.submit();
                }
            }
        },
        mounted() {
            this.$get('/webapi/account/get').then(response => {
                this.account = response.data.account;
            });
        },
        methods: {
            showPassword() {
                const amount = this.amount;
                if (!/^[0-9]+(.[0-9]{1,2})?$/.test(amount)) {
                    this.$toast.fail('请输入提现金额');
                    return false;
                }

                if ((amount % 100) !== 0) {
                    this.$toast.fail('提现金额必须为100的倍数');
                    return false;
                }

                if (amount > parseFloat(this.account.balance)) {
                    this.$toast.fail('提现金额不能大于账户余额');
                    return false;
                }

                this.showPopup = true;
                this.showKeyboard = true;
            },
            submit() {
                const amount = this.amount;
                const password = this.password;

                if (this.submiting) {
                    return false
                } else {
                    this.submiting = true;
                }

                this.$post('/webapi/account/withdraw', {
                    amount,
                    password
                }).then(response => {
                    this.$showToast('申请提现成功,请等待管理员确认', () => {
                        window.history.go(-1);
                    });
                }).catch(reason => {
                    this.$toast.fail(reason.data.errmsg);
                    this.password = '';
                    this.submiting = false;
                });
            },
        }
    }
</script>

<style scoped>

</style>
