@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('block/items?block_id='.$block_id)}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>内容模块->模块管理->添加项目</h2>
    </div>
    <div class="content-div">
        <form method="post" id="FrmItem">
            @csrf
            <table cellspacing="0" cellpadding="0" width="100%" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td class="cell-name" width="80">图片</td>
                    <td width="320">
                        <div class="bg-cover border-default" id="J_preview" title="点击选择图片" style="background-image: url({{$item['image']}}); width: 100px; height: 100px;">
                            <input type="hidden" name="item[image]" value="{{$item['image']}}" id="J_item_image">
                        </div>
                    </td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">标题</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[title]" value="{{$item['title']}}" id="title"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">副标题</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[subtitle]" value="{{$item['subtitle']}}" id="subtitle"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">链接</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[url]" value="{{$item['url']}}" id="url"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">附加字段1</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[field_1]" value="{{$item['field_1']}}"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">附加字段2</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[field_2]" value="{{$item['field_2']}}"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td class="cell-name">附加字段3</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="item[field_3]" value="{{$item['field_3']}}"></td>
                    <td class="tips"></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" class="btn btn-primary w100" value="提交"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("#J_preview").on('click', function () {
                Widget.showImagePicker(function (data) {
                    $("#J_item_image").val(data.image);
                    $("#J_preview").css({'background-image':'url('+data.image+')'});
                });
            });

            $("#FrmItem").on('submit', function (e) {
                var title = $.trim($("#title").val());
                if (!title) {
                    DSXUI.showToast('请填写标题');
                    return false;
                }
                var url = $.trim($("#url").val());
                if (!url) {
                    DSXUI.showToast('请填写链接地址');
                    return false;
                }
            });
        });
    </script>
@stop
