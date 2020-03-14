@extends('layouts.seller')

@section('title', '店铺设置')

@section('content')
    <div class="console-title">
        <h2>店铺设置</h2>
    </div>
    @if ($shop['closed'])
        <div class="alert alert-warning">
            你的店铺由于资料不全，已被管理员关闭，请完善店铺资料和认证资料，向管理员申请重新开启。
        </div>
    @endif
    <div class="content-div">
        <form method="post" id="Form" autocomplete="off">
            @csrf
            <table cellspacing="0" cellpadding="0" width="100%" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td class="cell-name" width="80">店铺名称</td>
                    <td><input title="" type="text" name="shop[shop_name]" value="{{$shop['shop_name']}}" id="shop_name" class="form-control w300"></td>
                </tr>
                <tr>
                    <td class="cell-name">客服电话</td>
                    <td><input title="" type="text" name="shop[phone]" value="{{$shop['phone']}}" id="phone" class="form-control w300"></td>
                </tr>
                <tr>
                    <td class="cell-name">店铺标志</td>
                    <td>
                        <input type="hidden" name="shop[logo]" value="{{$shop['logo']}}" id="logo">
                        <img src="{{$shop['logo']}}" width="100" height="100" id="logo_preview">
                        <p style="padding-top: 5px; display: block;">
                            <span class="btn btn-default btn-sm w100" id="upload-logo">上传图标</span>
                            <span>文件格式GIF、JPG、JPEG、PNG文件大小100K以内，建议尺寸150px*150px</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">店铺简介</td>
                    <td>
                        <textarea class="form-control" name="shop[description]" style="width: 300px; height: 80px;" placeholder="【掌柜签名】/【店铺动态】/【主营宝贝】">{{$shop['description']}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">经营地址</td>
                    <td>
                        <label>
                            <select title="" class="form-control custom-select width-auto" name="shop[province]" id="province">
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control custom-select width-auto" name="shop[city]" id="city" style="width: auto;">
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control custom-select width-auto" name="shop[district]" id="district" style="width: auto;">
                                <option value="">请选择</option>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">街道地址</td>
                    <td>
                        <label>
                            <input type="text" name="shop[street]" id="street" class="form-control w300" value="{{$shop['street']}}" placeholder="街道地址">
                        </label>
                        <label>
                            <a id="showMapLocation" style="color: #0B90EF;">地图定位</a>
                            <input type="hidden" name="shop[lat]" id="lat" value="{{$shop['lat']}}">
                            <input type="hidden" name="shop[lng]" id="lng" value="{{$shop['lng']}}">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">主要货源</td>
                    <td>
                        <label><input type="radio" name="shop[main_source]" value="1"@if($shop['main_source'] == 1) checked="checked"@endif> 自己生产</label>
                        <label><input type="radio" name="shop[main_source]" value="2"@if($shop['main_source'] == 2) checked="checked"@endif> 代工生产</label>
                        <label><input type="radio" name="shop[main_source]" value="3"@if($shop['main_source'] == 3) checked="checked"@endif> 线下批发</label>
                        <label><input type="radio" name="shop[main_source]" value="4"@if($shop['main_source'] == 4) checked="checked"@endif> 分销代销</label>
                        <label><input type="radio" name="shop[main_source]" value="5"@if($shop['main_source'] == 5) checked="checked"@endif> 自由渠道</label>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">店铺介绍</td>
                    <td>
                        <div style="width: 660px;">
                            @include('common.editor', ['name' => 'content[content]', 'content'=>$shop->content['content'], 'params'=>[]])
                        </div>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td width="80"></td>
                    <td colspan="2">
                        <button type="submit" class="btn btn-danger w100" id="submitButton">提交</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            var district = new DistrictSelector({
                province:'{{$shop['province']}}',
                city:'{{$shop['city']}}',
                district:'{{$shop['district']}}'
            });

            $("#upload-logo").on('click', function () {
                Widget.showImagePicker(function (data) {
                    $("#logo").val(data.image);
                    $("#logo_preview").attr('src', data.image);
                });
            });

            $("#showMapLocation").on('click', function () {
                Widget.showMapView({}, function (position) {
                    $("#lat").val(position.lat);
                    $("#lng").val(position.lng);
                });
            });
        });
    </script>
@stop
