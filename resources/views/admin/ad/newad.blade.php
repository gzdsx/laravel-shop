@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')
    <div class="console-title">
        <a href="{{admin_url('ad')}}" class="float-right">
            <span class="btn btn-primary">返回列表</span>
        </a>
        <h2>添加广告</h2>
    </div>
    <div class="content-div">
        <form method="post" id="adForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td width="80">广告名称</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="ad[title]"
                                           value="{{$ad['title']}}" id="title"></td>
                    <td class="tips">区分不同广告位的名称</td>
                </tr>
                <tr>
                    <td>开始时间</td>
                    <td><input title="" type="text" class="form-control w300" name="ad[begin_at]"
                               value="{{$ad['begin_at']}}" onclick="WdatePicker()"></td>
                    <td class="tips">广告开始有效时间</td>
                </tr>
                <tr>
                    <td>结束时间</td>
                    <td><input title="" type="text" class="form-control w300" name="ad[end_at]"
                               value="{{$ad['end_at']}}" onclick="WdatePicker()"></td>
                    <td class="tips">广告失效时间</td>
                </tr>
                <tr>
                    <td>广告类型</td>
                    <td>
                        <select title="" name="ad[type]" class="form-control w300" onChange="changeType(this.value)">
                            @foreach(trans('ad.ad_types') as $k=>$v)
                                <option value="{{$k}}"{{$ad->type==$k ? ' selected="selected"' : ''}}>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="tips"></td>
                </tr>
                </tbody>
                <tbody id="adtext" class="adtype" style="display:none;">
                <tr>
                    <td>文字</td>
                    <td><input title="" type="text" class="form-control w300" name="addata[text][text]"
                               value="{{$addata['text']['text']??''}}"></td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td>链接</td>
                    <td><input title="" type="text" class="form-control w300" name="addata[text][link]"
                               value="{{$addata['text']['link']??''}}"></td>
                    <td class="tips"></td>
                </tr>
                </tbody>
                <tbody id="adimage" class="adtype" style="display:none;">
                <tr>
                    <td>图片</td>
                    <td>
                        <div class="bg-cover" id="image_preview"
                             style="width: 100px; height: 100px; background-color: #f5f5f5; display: block; background-image: url({{image_url($addata['image']['image']??'')}})">
                        </div>
                        <input type="hidden" id="addata_image" name="addata[image][image]"
                               value="{{$addata['image']['image']??''}}">
                    </td>
                    <td class="tips">上传新图片将会替换原有图片</td>
                </tr>
                <tr>
                    <td>宽度(可选)</td>
                    <td><input title="" type="text" class="form-control w300" name="addata[image][width]"
                               value="{{$addata['image']['width']??''}}"></td>
                    <td class="tips">图片显示宽度</td>
                </tr>
                <tr>
                    <td>高度(可选)</td>
                    <td><input title="" type="text" class="form-control w300" name="addata[image][height]"
                               value="{{$addata['image']['height']??''}}"></td>
                    <td class="tips">图片显示高度</td>
                </tr>
                <tr>
                    <td>链接</td>
                    <td><input title="" type="text" class="form-control w300" name="addata[image][link]"
                               value="{{$addata['image']['link']??''}}"></td>
                    <td class="tips">图片链接</td>
                </tr>
                </tbody>
                <tbody id="adcode" class="adtype" style="display:none;">
                <tr>
                    <td>广告代码</td>
                    <td><textarea title="" class="form-control w300" name="addata[code]"
                                  style="height: 200px;">{{$addata['code']??''}}</textarea></td>
                    <td class="tips">广告HTML代码</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="submit" class="btn btn-primary" value="提交">
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        changeType('{{$ad['type']}}');

        function changeType(type) {
            if (!type) type = 'text';
            $(".adtype").hide();
            $("#ad" + type).show();
        }

        $(function () {
            $("#image_preview").on('click', function () {
                Widget.showImagePicker(function (data) {
                    $("#image_preview").css({'background-image': 'url(' + data.image + ')'});
                    $("#addata_image").val(data.image);
                });
            });
            $("#adForm").on('submit', function () {
                var title = $.trim($("#title").val());
                if (!title) {
                    DSXUI.error('标题不能为空');
                    return false;
                }
            })
        });
    </script>
@stop
