@extends('layouts.admin')

@section('title', '编辑分类')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('item/catlog')}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>商品管理 > {{$catlog->catid ? '编辑分类' : '添加分类'}}</h2>
    </div>
    <div class="content-div">
        <form method="post" id="Form">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td width="80">分类名称</td>
                    <td width="320"><input type="text" title="" class="form-control w300" name="catlog[name]" value="{{$catlog['name']}}" id="name"></td>
                    <td class="tips">分类名称，20个字符以内，不要使用特殊字符和符号</td>
                </tr>
                <tr>
                    <td>上级分类</td>
                    <td>
                        <select name="catlog[fid]" class="form-control custom-select w300" title="">
                            <option value="0">无上级分类</option>
                            @foreach ($catlogs as $cat)
                                <option value="{{$cat['catid']}}"@if($catlog['fid']==$cat['catid']) selected="selected"@endif>{{$cat['name']}}</option>
                                @foreach ($cat['childs'] as $child)
                                    <option value="{{$child['catid']}}"@if($catlog['fid']==$child['catid']) selected="selected"@endif>|--{{$child['name']}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td class="tips">选择上级分类</td>
                </tr>
                <tr>
                    <td>可发布内容</td>
                    <td>
                        <label><input type="radio" name="catlog[available]" value="1"@if($catlog['available']) checked="checked"@endif> 是 </label>
                        <label><input type="radio" name="catlog[available]" value="0"@if(!$catlog['available']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="tips">在发布内容是分类是否可选</td>
                </tr>
                <tr>
                    <td>首页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_index]" value="{{$catlog['template_index']}}"></td>
                    <td class="tips">分类首页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>列表页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_list]" value="{{$catlog['template_list']}}"></td>
                    <td class="tips">分类列表页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>详细页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_detail]" value="{{$catlog['template_detail']}}"></td>
                    <td class="tips">分类详细页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>SEO关键字</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[keywords]" value="{{$catlog['keywords']}}"></td>
                    <td class="tips">分类关键字,留空将使用系统默认</td>
                </tr>
                <tr>
                    <td>SEO描述</td>
                    <td><textarea title="" class="form-control w300" name="catlog[description]" style="height: 80px;">{{$catlog['description']}}</textarea></td>
                    <td class="tips">分类描述,留空将使用系统默认</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="5">
                        <input type="submit" class="btn btn-primary w100" value="提交" id="submitButton"@if(!$catlog->catid) disabled="disabled"@endif>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(document).on('click keyup', function () {
            if ($("#name").val().length > 0) {
                $("#submitButton").enable();
            } else {
                $("#submitButton").disable();
            }
        });
    </script>
@stop
