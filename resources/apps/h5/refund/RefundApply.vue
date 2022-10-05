<template>
    <div class="refund">
        <van-cell-group>
            <van-cell>
                <div class="refund-item" v-for="(item,index) in items" :key="index">
                    <div class="refund-item-pic">
                        <img :src="item.thumb" class="pic" alt="">
                    </div>
                    <div class="flex-fill flex-column">
                        <div class="refund-item-title">{{item.title}}</div>
                        <div class="refund-item-sku">{{item.sku_title}}</div>
                        <div class="flex-fill"></div>
                        <div class="flex-row">
                            <div class="flex-fill">￥{{item.price}}</div>
                            <div>x{{item.quantity}}</div>
                        </div>
                    </div>
                </div>
            </van-cell>
        </van-cell-group>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">退款信息</strong>
            </van-cell>
            <van-cell title="货物状态" value-class="flex-none">
                <van-radio-group v-model="refund.receive_state" direction="horizontal">
                    <van-radio :name="1">已收到货</van-radio>
                    <van-radio :name="0">未收到货</van-radio>
                </van-radio-group>
            </van-cell>
            <van-cell title="退货原因" is-link @click="showPicker=true">
                <div>{{refund.refund_reason}}</div>
            </van-cell>
            <van-cell value-class="flex-none">
                <div class="flex-row" slot="title">
                    <div class="flex-fill">退款金额</div>
                    <div>
                        <input type="text" class="refund-amount" v-model="refund.refund_amount">
                    </div>
                </div>
                <div slot="label">可修改，最多￥{{refund.refund_amount}}，包含运费￥{{refund.shipping_fee}}</div>
            </van-cell>
        </van-cell-group>
        <div class="h10"></div>
        <van-cell-group>
            <van-cell size="large">
                <strong slot="title">补充描述和凭证</strong>
            </van-cell>
            <van-field type="textarea" placeholder="补充描述，有助于商家更好的处理售后问题" v-model="refund.refund_desc"/>
            <van-cell>
                <van-uploader
                        v-model="images"
                        :max-count="3"
                        :max-size="3 * 1024 * 1024"
                        :multiple="true"
                />
                <p class="tips font-12">上传凭证,最多3张</p>
            </van-cell>
        </van-cell-group>
        <div style="padding: 15px;">
            <van-button round type="info" class="w-100" @click="onSubmit">提交</van-button>
        </div>
        <van-popup position="bottom" v-model="showPicker">
            <van-picker
                    show-toolbar
                    :columns="reasons"
                    @confirm="onChooseReason"
                    @cancel="showPicker = false"
                    title="选择退款原因"
            />
        </van-popup>
    </div>
</template>

<script>

    export default {
        name: "ApplyApp",
        data() {
            return {
                refund: {},
                items: [],
                order: {},
                images: [],
                reasons: [],
                submited: false,
                showPicker: false,
                totalAmount: 0,
            }
        },
        mounted() {
            const {order_id, sub_order_id, refund_type} = this.$route.query;
            this.$post('/refund/apply', {order_id, suborders: [sub_order_id], refund_type}).then(response => {
                const {refund} = response.result;
                const {items, order, images, refund_amount} = refund;
                this.refund = refund;
                this.items = items;
                this.order = order;
                this.images = images.map((img) => {
                    img.url = img.thumb;
                    return img;
                });
                this.totalAmount = refund_amount;
            })
            this.fetchReasons();
        },
        methods: {
            fetchReasons() {
                this.$get('/refundreason/getall').then(response => {
                    this.reasons = response.result.items.map(d => d.title);
                });
            },
            async onSubmit() {
                const refund = this.refund;
                const {order_id} = this.order;
                const {refund_amount, refund_reason} = refund;
                if (!refund_reason) {
                    this.$showToast('请选择退款原因');
                    return false;
                }

                if (!/^[0-9]+(.[0-9]{1,2})?$/.test(refund_amount)) {
                    this.$showToast('退款金额必须是数字');
                    return false;
                }

                if (refund_amount < 0.01) {
                    this.$showToast('退款金额必须大于0');
                    return false;
                }

                if (refund_amount > this.totalAmount) {
                    this.$showToast('退款金额必须不能大于大于' + this.totalAmount);
                    return false;
                }

                if (this.submited) return;
                this.uploadImages().then(images => {
                    this.submited = true;
                    const {refund_id} = refund;
                    if (refund_id) {
                        this.$post('/refund/save', {
                            refund_id,
                            refund,
                            images
                        }).then(response => {
                            this.$router.replace({path: '/refund/detail', query: {refund_id}});
                        });
                    } else {
                        this.$post('/refund/create', {
                            refund,
                            images,
                            order_id,
                            suborders: this.items.map((item) => item.sub_order_id),
                        }).then(response => {
                            const {refund_id} = response.result.refund;
                            this.$router.replace({path: '/refund/detail', query: {refund_id}});
                        });
                    }
                });
            },
            async uploadImages() {
                let images = [];
                for (let imgFile of this.images) {
                    if (imgFile.content) {
                        var formData = new FormData();
                        formData.append('file', imgFile.file, imgFile.file.name);
                        var response = await this.$post('/material/uploadimg', formData, {
                            headers: {'Content-Type': 'multipart/form-data'}
                        });
                        images.push(response.result.image);
                    } else {
                        images.push(imgFile);
                    }
                }

                return new Promise((resolve, reject) => {
                    resolve(images);
                });
            },
            onChooseReason(v) {
                this.refund.refund_reason = v;
                this.showPicker = false;
            },
        }
    }
</script>

<style lang="scss" scoped>
    body {
        background-color: #fff;
    }
</style>
