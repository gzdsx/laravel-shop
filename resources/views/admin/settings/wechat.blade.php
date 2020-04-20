@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->微信公众号设置</h2>
    </div>
    <div class="content-div">
        <form method="post" action="{{admin_url('settings')}}">
            @csrf
            <table class="dsxui-formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td class="cell-label" width="110">文章图片:</td>
                    <td class="cell-input" width="320">
                        <input id="imgValue" type="hidden" name="settings[wechat_subscribe_msg_img]" value="{{setting('wechat_subscribe_msg_img')}}">
                        <div id="img" class="bg-cover w150 h150 border-default" style="background-image: url({{image_url(setting('wechat_subscribe_msg_img'))}})"></div>
                    </td>
                    <td class="cell-tips">关注公众号时自动回复图文消息配图</td>
                </tr>
                <tr>
                    <td class="cell-label">文章标题:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[wechat_subscribe_msg_title]" value="{{$settings['wechat_subscribe_msg_title'] ?? ''}}">
                    </td>
                    <td class="cell-tips">关注公众号时自动回复图文标题</td>
                </tr>
                <tr>
                    <td class="cell-label">文字说明:</td>
                    <td class="cell-input">
                        <textarea class="form-control h100" title="" name="settings[wechat_subscribe_msg_text]">{{$settings['wechat_subscribe_msg_text'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">关注公众号时自动回复文字说明</td>
                </tr>
                <tr>
                    <td class="cell-label">文章链接:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[wechat_subscribe_msg_url]" value="{{$settings['wechat_subscribe_msg_url'] ?? ''}}">
                    </td>
                    <td class="cell-tips">关注公众号时自动回复图文链接</td>
                </tr>
                <tr>
                    <td class="cell-label">客服openID:</td>
                    <td class="cell-input">
                        <textarea class="form-control h100" title="" name="settings[wechat_kefu_openid]">{{$settings['wechat_kefu_openid'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">用于客服下单时接收模板消息提醒,填写openID，每行一个</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" class="btn btn-primary w100">更新配置</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $("#img").on('click',function () {
            var _this = this;
            Widget.showImagePicker(function (d) {
                $(_this).css({'background-image':'url('+d.image+')'});
                $("#imgValue").val(d.image);
            });
        });
    </script>
@stop
