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
                                <p class="tips">最多￥{{totalAmount}},包含运费￥{{refund.shipping_fee}}</p>
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
                                             v-for="(img,idx) in images"
                                             :key="idx"
                                        >
                                            <el-image :src="img.thumb" fit="cover" class="image-item"></el-image>
                                            <div class="iconfont icon-close_light del-icon"
                                                 @click.stop="images.splice(idx,1)"></div>
                                        </div>
                                    </div>
                                    <div class="dsxui-uploader-button" @click="showImagePicker=true"
                                         v-if="images.length<3">
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
                                <el-button size="medium" type="primary" class="w200" @click="handleSubmit">
                                    提交
                                </el-button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="refund-order">
                    <div class="refund-order-title">订单详情</div>
                    <div class="flex-row item-info" v-for="(item,index) in items" :key="index">
                        <div class="item-thumb">
                            <img :src="item.thumb" class="img-50" alt="">
                        </div>
                        <div class="flex-fill">
                            <div class="item-title">{{item.title}}</div>
                            <p class="item-sku">{{item.sku_title}}</p>
                            <div class="flex-row">
                                <div class="flex-fill">￥{{item.price}}</div>
                                <div>x{{item.quantity}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">订单编号</span>
                        <span>:</span>
                        <div class="refund-order-row-value">{{order.order_no}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">商品总价</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{order.goods_fee}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">运费</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{order.shipping_fee}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">优惠金额</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{order.discount_fee}}</div>
                    </div>
                    <div class="refund-order-row">
                        <span class="refund-order-row-label">实付金额</span>
                        <span>:</span>
                        <div class="refund-order-row-value">￥{{order.order_fee}}</div>
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
        name: "RefundApply",
        components: {
            ImagePicker
        },
        data() {
            return {
                item: {},
                refund: {},
                order: {},
                items: [],
                images: [],
                reasons: [],
                showImagePicker: false,
                totalAmount: 0
            }
        },
        mounted() {
            const {order_id, sub_order_id, refund_id} = this.$route.query;
            if (refund_id) {
                this.$get('/refund/get', {refund_id}).then(response => {
                    const {refund} = response.result;
                    const {images, items, order} = refund;
                    this.refund = refund;
                    this.images = images;
                    this.items = items;
                    this.order = order;
                    this.totalAmount = refund.refund_amount;
                });
            } else {
                this.$post('/refund/apply', {order_id, suborders: [sub_order_id]}).then(response => {
                    const {refund} = response.result;
                    const {images, items, order} = refund;
                    this.refund = refund;
                    this.images = images;
                    this.items = items;
                    this.order = order;
                    this.totalAmount = refund.refund_amount;
                });
            }
            this.fetchReasons();
        },
        methods: {
            fetchReasons() {
                this.$get('/refundreason/getall').then(response => {
                    this.reasons = response.result.items;
                });
            },
            handlePickedImage: function (img) {
                this.images.push({
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

                if (!/^[0-9]+(.[0-9]{1,2})?$/.test(refund_amount)) {
                    this.$showToast('退款金额必须是数字');
                    return false;
                }

                if (refund_amount <= 0) {
                    this.$showToast('退款金额必须大于0');
                    return false;
                }

                if (refund_amount > this.totalAmount) {
                    this.$showToast('退款金额不能大于大于' + this.totalAmount);
                    return false;
                }

                const images = this.images;
                const {refund_id} = refund;
                if (refund_id) {
                    this.$post('/refund/save', {refund_id, refund, images}).then(response => {
                        this.refund = response.result.refund;
                        this.$router.replace({path: '/refund/detail', query: {refund_id: this.refund.refund_id}});
                    });
                } else {
                    const {order_id, sub_order_id} = this.$route.query;
                    this.$post('/refund/create', {
                        order_id,
                        refund,
                        images,
                        suborders: [sub_order_id]
                    }).then(response => {
                        this.refund = response.result.refund;
                        this.$router.replace({path: '/refund/detail', query: {refund_id: this.refund.refund_id}});
                    });
                }
            },
        }
    }
</script>

<style scoped>

</style>
