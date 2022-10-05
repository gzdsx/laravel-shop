<template>
    <div>
        <header class="page-header">
            <div class="page-title">退款详情</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="refund flex-row">
                    <div class="flex-fill">
                        <div class="refund-info" v-if="refund.refund_id">
                            <h3>{{refund.refund_state_des}}</h3>
                            <ul class="tips">
                                <li>如果您同意，系统将退款给买家</li>
                                <li>如果你拒绝，买家可以修改申请重新提交</li>
                                <li>如果你逾期未处理，系统将自动退款给买家</li>
                            </ul>
                            <div class="op-buttons" v-if="refund.refund_state===1">
                                <template v-if="refund.refund_type===1">
                                    <el-button size="small" class="w200" type="primary" @click="resolveRefund">
                                        同意退款
                                    </el-button>
                                    <el-button size="small" class="w200" @click="rejectRefund">拒绝退款</el-button>
                                </template>
                                <template v-else>
                                    <el-button size="small" class="w200" type="primary" @click="resolveRefund">
                                        同意退款协议
                                    </el-button>
                                    <el-button size="small" class="w200" @click="rejectRefund">拒绝退款协议</el-button>
                                </template>
                            </div>
                            <div class="op-buttons" v-if="refund.refund_state===4">
                                <el-button size="small" class="w200" type="primary" @click="resolveRefund">
                                    确认收货,同意退款
                                </el-button>
                                <el-button size="small" class="w200" @click="rejectRefund">拒绝退款</el-button>
                            </div>
                            <div class="h30"></div>
                            <h3>退款信息</h3>
                            <div class="refund-info-detail">
                                <dl>
                                    <dt>服务类型:</dt>
                                    <dd>{{refund.refund_type_des}}</dd>
                                </dl>
                                <dl>
                                    <dt>退款原因:</dt>
                                    <dd>{{refund.refund_reason}}</dd>
                                </dl>
                                <dl>
                                    <dt>退款金额:</dt>
                                    <dd>{{refund.refund_amount}}</dd>
                                </dl>
                                <dl>
                                    <dt>退货运费:</dt>
                                    <dd>{{refund.shipping_fee}}</dd>
                                </dl>
                                <dl>
                                    <dt>申请时间:</dt>
                                    <dd>{{refund.created_at}}</dd>
                                </dl>
                                <dl>
                                    <dt>退款编号:</dt>
                                    <dd>{{refund.refund_no}}</dd>
                                </dl>
                                <dl v-if="refund.refund_desc">
                                    <dt>退款说明:</dt>
                                    <dd>{{refund.refund_desc}}</dd>
                                </dl>
                                <dl v-if="images.length > 0">
                                    <dt>相关图片:</dt>
                                    <dd>
                                        <div class="dsxui-uploader-files">
                                            <div class="dsxui-uploader-files-item" v-for="(image, idx) in images"
                                                 :key="idx">
                                                <a :href="image.image" target="_blank">
                                                    <img :src="image.thumb"
                                                         class="img-90 img-fit-cover"
                                                         alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="h20"></div>
                    </div>

                    <div class="refund-order">
                        <div class="refund-order-title">订单详情</div>
                        <div class="flex-row item-info" v-for="(item,index) in items">
                            <div class="item-thumb">
                                <img :src="item.thumb" class="img-50" alt="">
                            </div>
                            <div class="flex-fill flex-column">
                                <div class="flex-fill">
                                    <div class="item-title">{{item.title}}</div>
                                    <p class="item-sku">{{item.sku_title}}</p>
                                </div>
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
                        <div class="refund-order-row" v-if="refund.order">
                            <span class="refund-order-row-label">买家账号</span>
                            <span>:</span>
                            <div class="refund-order-row-value">{{order.buyer_name}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog title="选择地址" :visible.sync="showDialog" :close-on-click-modal="false" :close-on-press-escape="false">
            <table class="dsxui-listtable" cellspacing="0">
                <thead>
                <tr>
                    <th width="50">选择</th>
                    <th width="100">联系人</th>
                    <th width="160">电话</th>
                    <th>地址</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(address,index) in addresses" :key="index">
                    <td>
                        <el-radio v-model="addressIndex" :label="index">{{''}}</el-radio>
                    </td>
                    <td height="50"><b>{{address.name}}</b></td>
                    <td>{{address.tel}}</td>
                    <td>{{address.full_address}}</td>
                </tr>
                </tbody>
            </table>
            <div slot="footer" class="dialog-footer">
                <el-button size="medium" @click="showDialog = false">取 消</el-button>
                <el-button size="medium" type="primary" @click="handleUpdateShipping">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "RefundDetail",
        data() {
            return {
                refund: {},
                order: {},
                images: [],
                items: [],
                addresses: [],
                showDialog: false,
                addressIndex: 0
            }
        },
        mounted() {
            this.fetchData();
            this.fetchAddressList();
        },
        methods: {
            fetchData() {
                let {refund_id} = this.$route.params;
                this.$get('/trade/refund.info', {refund_id}).then(response => {
                    const {refund} = response.result;
                    const {order, images, items, user} = refund;
                    this.refund = refund;
                    this.items = items;
                    this.order = order;
                    this.images = images;
                });
            },
            fetchAddressList() {
                this.$get('/refund/address.list').then(response => {
                    this.addresses = response.result.items;
                });
            },
            handleProcess(action_type) {
                let {refund_id} = this.$route.query;
                this.$post('/refund/process', {
                    refund_id,
                    action_type
                }).then(response => {
                    const {refund} = response.result;
                    this.refund = {
                        ...this.refund,
                        ...refund
                    }
                });
            },
            saveRefund() {
                let {refund_id} = this.$route.query;
                this.$post('/refund/resolve', {refund_id}).then(response => {
                    const {refund} = response.result;
                    this.refund = {
                        ...this.refund,
                        ...refund
                    }
                });
            },
            resolveRefund() {
                const refund = this.refund;
                if (refund.refund_state === 1) {
                    this.showDialog = true;
                } else {
                    this.saveRefund();
                }
            },
            rejectRefund() {
                let {refund_id} = this.$route.query;
                this.$post('/refund/reject', {refund_id}).then(response => {
                    const {refund} = response.result;
                    this.refund = {
                        ...this.refund,
                        ...refund
                    }
                });
            },
            handleUpdateShipping() {
                let {refund_id} = this.$route.query;
                const shipping = this.addresses[this.addressIndex];
                this.$post('/trade/refund.shipping.update', {refund_id, shipping}).then(response => {
                    this.showDialog = false;
                    this.saveRefund();
                });
            }
        }
    }
</script>

<style scoped>

</style>
