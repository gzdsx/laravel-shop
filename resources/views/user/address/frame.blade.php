<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>编辑收货地址</title>
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/entry/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="content-div">
    <form method="post" id="Form" action="{{url('user/address/store')}}">
        {{csrf_field()}}
        <input type="hidden" name="address_id" value="{{$address_id}}">
        <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-formtable">
            <tr>
                <td class="cell-label" width="80">收货人</td>
                <td><input title="" type="text" class="form-control w200" id="consignee" name="address[consignee]" value="{{$address['consignee']}}"></td>
            </tr>
            <tr>
                <td class="cell-label">联系电话</td>
                <td><input title="" type="text" class="form-control w200" id="phone" name="address[phone]" value="{{$address['phone']}}"></td>
            </tr>
            <tr>
                <td class="cell-label">所在地</td>
                <td>
                    <label>
                        <select class="custom-select width-auto" id="province" name="address[province]">
                            <option value="">请选择</option>
                        </select>
                    </label>
                    <label>
                        <select class="custom-select width-auto" id="city" name="address[city]">
                            <option value="">请选择</option>
                        </select>
                    </label>
                    <label>
                        <select class="custom-select width-auto" id="district" name="address[district]">
                            <option value="">请选择</option>
                        </select>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="cell-label">街道地址</td>
                <td><input title="" type="text" class="form-control w400" id="street" name="address[street]" value="{{$address['street']}}"></td>
            </tr>
            <tr>
                <td class="cell-label">邮政编码</td>
                <td><input title="" type="text" class="form-control w100" id="zipcode" name="address[zipcode]" value="{{$address['zipcode']}}" maxlength="6"></td>
            </tr>
            <tr>
                <td class="cell-label"></td>
                <td>
                    <label>
                        <input type="checkbox" name="address[isdefault]" value="1"@if($address['isdefault']) checked="checked"@endif>
                        <span>设为默认收货地址</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" id="submitButton" class="btn btn-primary w100" value="提交"></td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        new DistrictSelector({
            province:'{{$address['province']}}',
            city:'{{$address['city']}}',
            district:'{{$address['district']}}'
        });
        $("#submitButton").on('click', function () {
            var consignee = $.trim($("#consignee").val());
            if (!consignee) {
                DSXUI.showToast('请填写收货人姓名');
                return false;
            }

            var phone = $.trim($("#phone").val());
            if (!phone) {
                DSXUI.showToast('请填写联系电话');
                return false;
            }

            var province = $("#province").val();
            var city = $("#city").val();
            var district = $("#district").val();
            if (!province || !city || !district){
                DSXUI.showToast('请选择所在地');
                return false;
            }
            var street = $.trim($("#street").val());
            if (!street) {
                DSXUI.showToast('请填写街道地址');
                return false;
            }
            var zipcode = $.trim($("#zipcode").val());
            if (!zipcode) {
                DSXUI.showToast('请填写邮政编码');
                return false;
            }
            $("#Form").ajaxSubmit({
                success:function (response) {
                    if (response.errcode) {
                        DSXUI.showToast(response.errmsg);
                    } else {
                        if (window.parent.afterSaveAddress) {
                            window.parent.afterSaveAddress(response.address);
                        }
                    }
                }
            });
        });
    });
</script>
</body>
</html>
