<template>
    <div class="container">
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">退货地址</strong>
            </van-cell>
            <van-cell title="收货人" :value="shipping.name"></van-cell>
            <van-cell title="联系电话" :value="shipping.tel"></van-cell>
            <van-cell title="收货地址" :value="shipping.full_address"></van-cell>
        </van-cell-group>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">退货物流</strong>
            </van-cell>
            <van-field
                    v-model="shipping.express_name"
                    label="物流公司"
                    placeholder="请选择快递公司"
                    :rules="[{ required: true, message:'请选择快递公司' }]"
                    readonly
                    @click="showPopup=true"
            />
            <van-field
                    v-model="shipping.express_no"
                    type="text"
                    label="快递单号"
                    placeholder="请填写快递单号"
                    :rules="[{ required: true, message:'快递单号不能为空'}]"
            >
                <span class="iconfont icon-scan font-24" slot="right-icon" @click="onScan"></span>
            </van-field>
        </van-cell-group>
        <div style="padding: 15px;">
            <van-button round type="info" class="w-100" @click="onSubmit">提交</van-button>
        </div>
        <van-popup position="bottom" v-model="showPopup">
            <van-picker
                    :columns="expresses"
                    show-toolbar
                    title="选择快递公司"
                    @confirm="onChooseExpress"
                    @cancel="showPopup = false"
            />
        </van-popup>
    </div>
</template>

<script>
    export default {
        name: "RefundSend",
        data() {
            return {
                refund: {},
                items: {},
                shipping: {},
                expresses: [],
                showPopup: false
            }
        },
        mounted() {
            const {refund_id} = this.$route.query;
            this.$get('/refund/get', {refund_id}).then(response => {
                const {refund} = response.result;
                const {items, images, order, shipping} = refund;
                this.refund = refund;
                this.items = items;
                this.shipping = shipping || {};
            });
            this.fetchExpress();
        },
        methods: {
            fetchExpress() {
                this.$get('/express/getall').then(response => {
                    this.expresses = response.result.items.map((d) => {
                        return {
                            text: d.name,
                            value: d
                        }
                    });
                });
            },
            onSubmit() {
                const {refund_id} = this.refund;
                const {express_name, express_no} = this.shipping;
                if (!express_name) {
                    this.$showToast('请选择快递公司');
                    return false;
                }

                if (!express_no) {
                    this.$showToast('请填写快递单号');
                    return false;
                }

                this.$post('/refund/send', {refund_id, shipping: this.shipping}).then(response => {
                    this.$showToast('发货成功', () => {
                        window.history.go(-1);
                    });
                });
            },
            onScan() {
                let _this = this;
                let shipping = this.shipping;
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        //var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                        var arr = res.resultStr.split(',');
                        if (arr[1]) {
                            shipping.express_no = arr[1];
                        } else {
                            shipping.express_no = res.resultStr;
                        }
                        _this.shipping = shipping;
                    }
                });
            },
            onChooseExpress(v) {
                this.shipping.express_name = v.value.name;
                this.shipping.express_code = v.value.code;
                this.showPopup = false;
            },
        }
    }
</script>

<style scoped>

</style>
