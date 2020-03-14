@extends('layouts.h5')

@section('title', '开店')

@section('content')
    <div class="openshop" id="openshop">
        <div class="openshop-header">
            <img :src="shop.logo" class="logo-img" v-on:click="chooseImage('logo')">
            <div class="tips">上传一张店铺照片呗</div>
        </div>

        <div class="openshop-form">
            <div class="weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd cell-label">我的店铺</div>
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" placeholder="请填写店铺名称" v-model="shop.shop_name">
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd cell-label">你的姓名</div>
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" placeholder="店铺负责人姓名" v-model="auth.shop_owner">
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd cell-label">手机号码</div>
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" placeholder="负责人手机号码" v-model="shop.phone">
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__hd cell-label">所在地区</div>
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" placeholder="选择所在地区" :value="address" v-on:click="pickArea()" readonly>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__hd cell-label">详细地址</div>
                    <div class="weui-cell__bd">
                        <input type="text" class="weui-input" placeholder="请填写详细地址" v-model="shop.street">
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__bd" style="position: relative;">
                        <div style="height: 300px;" id="map"></div>
                        <div class="map-search">
                            <div style="padding: 0 10px;">
                                <input type="text" placeholder="输入地点" class="map-search-input" v-model="keywords">
                            </div>
                            <div class="map-search-btn" v-on:click="searchMap()">搜索</div>
                        </div>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <textarea class="weui-textarea" placeholder="请在这里填写店铺简介(选填)" v-model="shop.description"></textarea>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__bd text-center">
                        <input type="checkbox" :checked="agreement">
                        <span class="fontsize-14">我已经同意《证品荟商家平台经营规范协议》</span>
                    </div>
                </div>

                <div class="weui-btn-area">
                    <div class="weui-btn weui-btn_primary" v-on:click="submit()">提交审核</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src="https://webapi.amap.com/maps?v=1.4.8&key={{setting('amap_client_key')}}"></script>
    <script src="{{asset('js/dsxmap.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var mapObj,marker;
        wx.ready(function () {
            var app = new Vue({
                el:'#openshop',
                data:{
                    shop:{
                        shop_name:'',
                        logo:'{{asset('images/h5/user/camera.png')}}',
                        phone:'',
                        province:'',
                        city:'',
                        district:'',
                        street: '',
                        description:'',
                        lat:0,
                        lng:0
                    },
                    auth:{
                        shop_owner:'',
                        id_card_pic_1:'',
                        other_pic:''
                    },
                    address:'',
                    agreement:true,
                    area:[],
                    keywords:''
                },
                mounted:function(){
                    var $this = this;
                    mapObj = new DSXMap('map', {zoom:13});
                    marker = mapObj.createMarker({draggable:true});
                    mapObj.addMarker(marker);
                    AMap.event.addListener(marker,'dragend',function (e) {
                        var position = e.target.getPosition();
                        $this.shop.lat = position.getLat();
                        $this.shop.lng = position.getLng();
                    });

                    $.ajax({
                        url:'/h5/myshop/getshop',
                        success:function (response) {
                            //alert(JSON.stringify(response));
                            if (response.shop){
                                $this.shop = response.shop;
                                $this.auth = response.auth;
                                $this.address = $this.shop.province+'/'+$this.shop.city+'/'+$this.shop.district;
                                $this.area = [$this.shop.province, $this.shop.city, $this.shop.district];
                            }
                        }
                    });

                    wx.getLocation({
                        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                        success: function (res) {
                            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                            mapObj.map.setCenter([longitude, latitude]);
                            marker.setPosition([longitude, latitude]);
                        },
                        fail: function(){
                            console.log('微信定位失败；');
                        }
                    });
                },
                methods:{
                    chooseImage:function (type) {
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
                                                if (type == 'logo') {
                                                    $this.shop.logo = response.image.image;
                                                } else if (type == 'id'){
                                                    $this.auth.id_card_pic_1 = response.image.image;
                                                } else {
                                                    $this.auth.other_pic = response.image.image;
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    },
                    pickArea:function(){
                        var $this = this;
                        document.activeElement.blur();
                        $.ajax({
                            url:'/h5/getdistrictjson',
                            success:function (response) {
                                weui.picker(response, {
                                    onConfirm:function (result) {
                                        $this.shop.province = result[0].label;
                                        $this.shop.city = result[1].label;
                                        $this.shop.district = result[2].label;
                                        $this.address = result[0].label +'/'+ result[1].label +'/'+ result[2].label;
                                    },
                                    defaultValue:$this.area
                                });
                            }
                        });
                    },
                    submit:function () {
                        if (!this.shop.shop_name)
                        {
                            weui.topTips('请填写店铺名称');
                            return false;
                        }

                        if (!this.auth.shop_owner)
                        {
                            weui.topTips('请填写负责人姓名');
                            return false;
                        }

                        if (!this.shop.phone){
                            weui.topTips('请填写负责人电话');
                            return false;
                        }

                        if (!this.shop.province || !this.shop.city || !this.shop.district)
                        {
                            weui.topTips('请选择所在地区');
                            return false;
                        }

                        if (!this.shop.street)
                        {
                            weui.topTips('请填写街道地址');
                            return false;
                        }

                        // if (!this.auth.id_card_pic_1)
                        // {
                        //     weui.topTips('请上传身份证照片');
                        //     return false;
                        // }
                        //
                        // if (!this.shop.logo)
                        // {
                        //     weui.topTips('请上传店铺照片');
                        //     return false;
                        // }

                        var loading;
                        $.ajax({
                            type:'POST',
                            url:'/h5/myshop/store',
                            data:{shop:this.shop,auth:this.auth},
                            beforeSend:function(){
                                loading = weui.loading('正在保存...');
                            },
                            success:function () {
                                //window.location.href = '/h5/myshop';
                                loading.hide();
                                weui.toast('保存成功!');
                            },
                            complete:function (xhr) {
                                //alert(JSON.stringify(xhr));
                            }
                        });
                    },
                    searchMap:function () {
                        var $this = this;
                        var str = this.shop.city+this.shop.district +this.shop.street+ this.keywords;
                        mapObj.getLocation(str, function (data) {
                            var location = data[0].location;
                            mapObj.map.setCenter(location);
                            marker.setPosition(location);
                            $this.shop.lng = location.lng;
                            $this.shop.lat = location.lat;
                        }, function (status) {
                            //alert(JSON.stringify(status));
                        });
                    }
                }
            });
        });

    </script>
@stop
