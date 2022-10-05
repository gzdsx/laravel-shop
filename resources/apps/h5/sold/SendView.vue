<template>
    <van-form @submit="onSubmit">
        <van-field
                v-model="express_name"
                name="express_name"
                label="快递"
                placeholder="请选择快递公司"
                :rules="[{ required: true,message:'请选择快递公司' }]"
                readonly
                @click="showPopup=true"
        />
        <van-field
                v-model="express_no"
                type="text"
                name="express_no"
                label="单号"
                placeholder="请填写快递单号"
                :rules="[{ required: true, message:'快递单号不能为空'}]"
        >
            <span class="iconfont icon-scan font-24" slot="right-icon" @click="onScan"></span>
        </van-field>
        <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
                提交
            </van-button>
        </div>
        <van-popup position="bottom" v-model="showPopup">
            <van-picker
                    :columns="expresses"
                    show-toolbar
                    title="选择快递公司"
                    @confirm="onConfirm"
            />
        </van-popup>
    </van-form>
</template>

<script>
    export default {
        name: "SendView",
        props: {
            expresses: Array
        },
        data: function () {
            return {
                showPopup: false,
                express_id: 0,
                express_code: '',
                express_name: '',
                express_no: '',
                expresses: []
            }
        },
        mounted() {
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
            onSubmit: function (c) {
                this.$emit('send', {
                    express_id: this.express_id,
                    express_name: this.express_name,
                    express_no: this.express_no,
                    express_code: this.express_code,
                });
            },
            onConfirm: function (c) {
                const {id, name, code} = c.value;
                this.express_id = id;
                this.express_name = name;
                this.express_code = code;
                this.showPopup = false;
            },
            onScan: function () {
                var _this = this;
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        //var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                        var arr = res.resultStr.split(',');
                        if (arr[1]) {
                            _this.express_no = arr[1];
                        } else {
                            _this.express_no = res.resultStr;
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
