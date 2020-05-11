<template>
    <div class="content-block">
        <div class="console-title">
            <h2>订单管理->申请退款</h2>
        </div>
        <section>
            <div class="refund flex-row">
                <div class="refund-form">
                    <table class="dsxui-formtable">
                        <colgroup>
                            <col class="w80">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>退款商品</td>
                            <td>
                                <div class="refund-item">
                                    <img :src="item.thumb" class="refund-item-thumb" alt="">
                                    <div class="flex-fill">
                                        <div class="refund-item-title">{{item.title}}</div>
                                        <p class="refund-item-sku">{{item.sku_title}}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>服务类型</td>
                            <td>
                                <el-radio :label="1" v-model="refund.refund_type">仅退款</el-radio>
                                <el-radio :label="2" v-model="refund.refund_type">退款退货</el-radio>
                            </td>
                        </tr>
                        <tr>
                            <td>货物状态</td>
                            <td>
                                <el-radio :label="1" v-model="refund.receive_state">已收到货</el-radio>
                                <el-radio :label="0" v-model="refund.receive_state">未收到货</el-radio>
                            </td>
                        </tr>
                        <tr>
                            <td>退款原因</td>
                            <td>
                                <el-select class="w200" size="medium" v-model="refund.refund_reason">
                                    <el-option
                                            v-for="(r,i) in reasons"
                                            :label="r.title"
                                            :value="r.title"
                                            :key="i"
                                    ></el-option>
                                </el-select>
                            </td>
                        </tr>
                        <tr>
                            <td>退款金额</td>
                            <td>
                                <el-input size="medium" class="w200" v-model="refund.refund_amount"></el-input>
                                <p class="tips">最多￥{{item.total_fee}},包含运费￥{{item.shipping_fee}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>退款说明</td>
                            <td>
                                <el-input type="textarea" rows="5" class="w500" v-model="refund.refund_desc"></el-input>
                            </td>
                        </tr>
                        <tr>
                            <td>上传图片</td>
                            <td>
                                <div class="dsxui-uploader">
                                    <div class="dsxui-uploader-files">
                                        <div class="dsxui-uploader-files-item"
                                             v-for="(img,idx) in refund.images"
                                             :key="idx"
                                        >
                                            <el-image :src="img.thumb" fit="cover" class="image-item"></el-image>
                                            <div class="iconfont icon-close_light del-icon"
                                                 @click.stop="refund.images.splice(idx,1)"></div>
                                        </div>
                                    </div>
                                    <div class="dsxui-uploader-button" @click="showImagePicker=true"
                                         v-if="refund.images.length<3">
                                        <i class="el-icon-plus dsxui-uploader-icon"></i>
                                    </div>
                                </div>
                                <p class="tips">上传凭证,最多3张</p>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <el-button size="medium" type="primary" class="w200" @click="handleSubmit">提交
                                </el-button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="refund-order">
                    <div class="refund-order-title">订单详情</div>
                    <div class="flex-row item-info">
                        <div class="item-thumb">
                            <img :src="item.thumb" class="img-50" alt="">
                        </div>
                        <div class="flex-fill">
                            <div class="item-title">{{item.title}}</div>
                            <p class="item-sku">{{item.sku_title}}</p>
                        </div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">单价</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{item.price}}*{{item.quantity}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">运费</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{item.shipping_fee}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">商品总价</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{item.total_fee}}</div>
                    </div>
                </div>
            </div>
        </section>
        <image-picker v-model="showImagePicker" @confirm="handlePickedImage"></image-picker>
    </div>
</template>

<script>
    import ImagePicker from "../../lib/ImagePicker";

    export default {
        name: "ApplyRefund",
        components: {
            ImagePicker
        },
        data: function () {
            return {
                item: {},
                refund: {
                    refund_type: 1,
                    receive_state: 1,
                    images: []
                },
                reasons: [],
                showImagePicker: false
            }
        },
        mounted() {
            const {order_id, itemid} = this.$route.params;
            this.$get('/user/bought/getitem', {order_id, itemid}).then(response => {
                let item = response.data.item;
                if (item) {
                    this.item = item;
                    this.refund.refund_amount = item.total_fee;
                }
            });
            this.fetchReasons();
        },
        methods: {
            fetchReasons() {
                this.$get('/webapi/refundreason/getall').then(response => {
                    this.reasons = response.data.items;
                });
            },
            handlePickedImage: function (img) {
                this.refund.images.push({
                    thumb: img.thumb,
                    image: img.image
                });
            },
            handleSubmit() {
                const refund = this.refund;
                const {refund_amount, refund_reason} = refund;
                if (!refund_reason) {
                    this.$showToast('请选择退款原因');
                    return false;
                }

                if (isNaN(refund_amount)) {
                    this.$showToast('退款金额必须是数字');
                    return false;
                }

                if (refund_amount <= 0) {
                    this.$showToast('退款金额必须大于0');
                    return false;
                }

                const {order_id, itemid} = this.$route.params;
                this.$post('/user/bought/applyrefund', {refund, order_id, itemid}).then(response => {

                });
            }
        }
    }
</script>

<style scoped>

</style>
