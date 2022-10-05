<template>
    <div>
        <van-popup class="payment-popup" :close-on-click-overlay="false" @close="onClose" closeable
                   v-model="show">
            <div class="payment-popup-container">
                <div class="payment-popup-header">请输入支付密码</div>
                <div class="payment-popup-desc">余额支付</div>
                <div class="payment-popup-amount">
                    <i>￥</i>
                    <span>{{order.order_fee}}</span>
                </div>
                <div class="payment-popup-password">
                    <van-password-input
                            :value="password"
                            :focused="showKeyboard"
                            @focus="showKeyboard = true"
                            info="密码为6位数字，可在我的设置里设置"
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
        name: "PasswordPannel",
        props: {
            order: {
                type: Object,
                default: {}
            },
            show: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            callBalancePay() {
                let {order_id} = this.order;
                this.$post('/order/pay', {order_id, type: 'balance', password: this.password}).then(response => {
                    this.$emit('paid', this.order);
                    this.$toast.success('付款成功');
                }).catch(reason => {
                    if (reason.errCode === 530) {
                        this.$router.push('/security/paymentpassword');
                    } else {
                        this.$toast.fail(reason.errMsg);
                    }
                });
            },
            onClose(){
                this.showKeyboard = false;
                this.$emit('update:show', false);
                this.$emit('close');
            }
        },
        data() {
            return {
                password: '',
                showKeyboard: false
            }
        },
        mounted() {
        },
        watch: {
            password(val) {
                if (val.length === 6) {
                    this.onClose();
                    this.callBalancePay();
                }
            }
        },
    }
</script>

<style scoped>

</style>
