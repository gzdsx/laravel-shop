@extends('layouts.h5')

@section('title', '退款/售后')

@section('content')
    <div class="refund" id="refund">
        <div class="items">
            @foreach ($order->items as $item)
                <div class="list-item">
                    <div class="bg-cover image" style="background-image: url({{image_url($item['thumb'])}})"></div>
                    <div class="title">{{$item['title']}}</div>
                </div>
            @endforeach
        </div>

        <div class="weui-cells">
            <div class="weui-cell weui-cell_access" v-on:click="chooseReson()">
                <div class="weui-cell__hd">退款原因</div>
                <div class="weui-cell__bd"></div>
                <div class="weui-cell__ft">@{{ refund_reason||'请选择' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">退款金额</div>
                <div class="weui-cell__bd"></div>
                <div class="weui-cell__ft money">￥{{$order['total_fee']}}</div>
            </div>

            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="退款说明: 选填" v-model="buyer_message"></textarea>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <div class="weui-uploader__hd">
                        <div class="weui-uploader__title">上传凭证</div>
                    </div>
                    <div class="weui-uploader__hd">
                        <ul class="weui-uploader__files">
                            <template v-for="img in images">
                                <li class="weui-uploader__file" :style="{'background-image':'url('+img+')'}"></li>
                            </template>
                        </ul>
                        <div class="weui-uploader__input-box" v-on:click="uploadImg()"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="weui-cells__title" v-if="shipping_status">退货物流信息</div>
        <div class="weui-cells" v-if="shipping_status">
            <div class="weui-cell weui-cell_access" v-on:click="chooseExpress()">
                <div class="weui-cell__hd">快递公司</div>
                <div class="weui-cell__bd"></div>
                <div class="weui-cell__ft">@{{ refund_express_name }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd w90">快递单号</div>
                <div class="weui-cell__bd">
                    <input type="text" class="weui-input" placeholder="请填写快递单号" v-model="refund_express_no">
                </div>
            </div>
        </div>

        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary" v-on:click="submit()">提交</button>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var reasons = @json($reasons);
        var expresses = @json($expresses);
        var order = @json($order);
        var app = new Vue({
            el:'#refund',
            data:{
                order_id:'{{$order_id}}',
                refund_amount:'{{$order['total_fee']}}',
                refund_reason:'',
                buyer_message:'',
                refund_express_id:'',
                refund_express_no:'',
                refund_express_name:'请选择',
                shipping_status:order.shipping_status,
                images:[]
            },
            methods:{
                chooseReson:function () {
                    var data = [];
                    $(reasons).each(function (i, d) {
                        data.push({label:d.title, value:d.id});
                    });
                    weui.picker(data,{
                        onConfirm:function (result) {
                            app.refund_reason = result[0].label;
                        }
                    });
                },
                submit:function () {
                    if (!this.refund_reason)
                    {
                        weui.topTips('请选择退款原因');
                        return false;
                    }

                    if (this.shipping_status)
                    {
                        if (!this.refund_express_id)
                        {
                            weui.topTips('请选择快递公司');
                            return false;
                        }

                        if (!this.refund_express_no)
                        {
                            weui.topTips('请填写快递单号');
                            return false;
                        }
                    }
                    $.ajax({
                        type:'POST',
                        url:'/h5/bought/refund',
                        data:{
                            order_id:app.order_id,
                            refund_amount:app.refund_amount,
                            refund_reason:app.refund_reason,
                            buyer_message:app.buyer_message,
                            refund_express_id: app.refund_express_id,
                            refund_express_no: app.refund_express_no,
                            images: app.images
                        },
                        success:function (response) {
                            weui.toast('申请已提交',{
                                callback:function () {
                                    window.location.href = '{{$redirect}}';
                                }
                            });
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                },
                chooseExpress:function () {
                    var $this = this;
                    var data = [];
                    $(expresses).each(function (i,d) {
                        data.push({
                            label: d.name,
                            value: d.id
                        });
                    });
                    weui.picker(data,{
                        onConfirm:function (result) {
                            $this.refund_express_name = result[0].label;
                            $this.refund_express_id = result[0].value;
                        }
                    });
                },
                uploadImg:function () {
                    var $this = this;
                    wx.chooseImage({
                        count: 1, // 默认9
                        sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                        sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                        success: function (res) {
                            //alert(JSON.stringify(res));
                            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                            wx.uploadImage({
                                localId: localIds[0], // 需要上传的图片的本地ID，由chooseImage接口获得
                                isShowProgressTips: 1, // 默认为1，显示进度提示
                                success: function (res) {
                                    //alert(JSON.stringify(res));
                                    var serverId = res.serverId; // 返回图片的服务器端ID
                                    $.ajax({
                                        url:'/h5/myshop/getimage',
                                        data:{serverId:serverId},
                                        success:function (response) {
                                            $this.images.push(response.image.image);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            }
        });
    </script>
@stop
