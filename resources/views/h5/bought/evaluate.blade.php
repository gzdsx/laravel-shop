@extends('layouts.h5')

@section('title', '订单评价')

@section('content')
    <div class="app" id="app">
        <div class="evaluate">
            <div class="evaluate-hd">
                <img src="{{image_url($item['thumb'])}}" class="image">
                <div class="flex display-flex">
                    <div class="evaluate-item" v-on:click="setRateType(1)">
                        <span class="iconfont" :class="[rate_type==1 ? 'icon-haoping' : 'icon-haoping1']"></span>
                        <span>好评</span>
                    </div>
                    <div class="evaluate-item" v-on:click="setRateType(2)">
                        <span class="iconfont" :class="[rate_type==2 ? 'icon-medium-review' : 'icon-zhongping']"></span>
                        <span>中评</span>
                    </div>
                    <div class="evaluate-item" v-on:click="setRateType(3)">
                        <span class="iconfont icon-15chaping" :class="[rate_type==3 ? 'icon-16chaping' : 'icon-15chaping']"></span>
                        <span>差评</span>
                    </div>
                </div>
            </div>
            <div class="evaluate-row">
                <textarea class="weui-textarea" v-model="message" placeholder="请发表你对本次购物的体验和看法.." style="height: 200px;"></textarea>
            </div>
            <div class="evaluate-row">
                <div class="weui-uploader__hd">
                    <ul class="weui-uploader__files">
                        <template v-for="img in images">
                            <li class="weui-uploader__file" :style="{'background-image':'url('+img+')'}"></li>
                        </template>
                    </ul>
                    <div class="weui-uploader__input-box" v-on:click="uploadImg()"></div>
                </div>
            </div>

            <div class="evaluate-row display-flex">
                <div>描述相符：</div>
                <div class="flex display-flex">
                    <span class="iconfont" :class="[product_score > 0 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setProductScore(1)"></span>
                    <span class="iconfont" :class="[product_score > 1 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setProductScore(2)"></span>
                    <span class="iconfont" :class="[product_score > 2 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setProductScore(3)"></span>
                    <span class="iconfont" :class="[product_score > 3 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setProductScore(4)"></span>
                    <span class="iconfont" :class="[product_score > 4 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setProductScore(5)"></span>
                </div>
            </div>
            <div class="evaluate-row display-flex">
                <div>物流服务：</div>
                <div class="flex display-flex">
                    <span class="iconfont" :class="[wuliu_score > 0 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setWuliuScore(1)"></span>
                    <span class="iconfont" :class="[wuliu_score > 1 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setWuliuScore(2)"></span>
                    <span class="iconfont" :class="[wuliu_score > 2 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setWuliuScore(3)"></span>
                    <span class="iconfont" :class="[wuliu_score > 3 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setWuliuScore(4)"></span>
                    <span class="iconfont" :class="[wuliu_score > 4 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setWuliuScore(5)"></span>
                </div>
            </div>
            <div class="evaluate-row display-flex">
                <div>服务态度：</div>
                <div class="flex display-flex">
                    <span class="iconfont" :class="[service_score > 0 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setServiceScore(1)"></span>
                    <span class="iconfont" :class="[service_score > 1 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setServiceScore(2)"></span>
                    <span class="iconfont" :class="[service_score > 2 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setServiceScore(3)"></span>
                    <span class="iconfont" :class="[service_score > 3 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setServiceScore(4)"></span>
                    <span class="iconfont" :class="[service_score > 4 ? 'icon-favorfill' : 'icon-favor']" v-on:click="setServiceScore(5)"></span>
                </div>
            </div>

        </div>

        <div class="weui-btn-area">
            <div class="weui-btn weui-btn_primary" v-on:click="submit()">提交</div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                rate_type:1,
                message:'',
                images:[],
                product_score:0,
                wuliu_score:0,
                service_score:0
            },
            mounted:function () {

            },
            methods:{
                setRateType:function (type) {
                    this.rate_type = type;
                },
                setProductScore:function (score) {
                    this.product_score = score;
                },
                setWuliuScore:function (score) {
                    this.wuliu_score = score;
                },
                setServiceScore:function (score) {
                    this.service_score = score;
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
                },
                submit:function () {
                    var data = {
                        rate_type:this.rate_type,
                        message:this.message,
                        images:this.images,
                        product_score:this.product_score,
                        wuliu_score:this.wuliu_score,
                        service_score:this.service_score,
                        order_id:'{{$order_id}}'
                    };

                    $.ajax({
                        type:'POST',
                        url:'/h5/bought/evaluate',
                        data:data,
                        success:function () {
                            weui.toast('评价成功',{
                                callback:function () {
                                    window.location.href = '{{back()->getTargetUrl()}}';
                                }
                            });
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                }
            }
        });
    </script>
@stop
