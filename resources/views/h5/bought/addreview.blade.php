@extends('layouts.h5')

@section('title', '追加评论')

@section('content')
    <div class="app" id="app">
        <div class="evaluate">
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
                message:'',
                images:[],
            },
            mounted:function () {

            },
            methods:{
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
                    if (!this.message)
                    {
                        weui.topTips('请填写追加评论的内容');
                        return false;
                    }
                    var data = {
                        message:this.message,
                        images:this.images,
                        order_id:'{{$order_id}}'
                    };

                    $.ajax({
                        type:'POST',
                        url:'/h5/bought/addreview',
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
