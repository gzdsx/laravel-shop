@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('pages/category')}}" role="button">
                <span class="btn btn-primary">分类管理</span>
            </a>
            <a href="{{admin_url('pages?catid='.$page->catid)}}" role="button">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>{{$pageid ? '编辑页面' : '添加页面'}}</h2>
    </div>
    <div class="content-div">
        <form method="post" action="" id="Form">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tr>
                    <td width="60">标题</td>
                    <td><input type="text" title="" id="title" class="form-control w300" name="newpage[title]" value="{{$page['title']}}"></td>
                    <td width="60">别名</td>
                    <td><input type="text" title="" class="form-control w300" name="newpage[alias]" value="{{$page['alias']}}"></td>
                </tr>
                <tr>
                    <td>分类</td>
                    <td>
                        <select name="newpage[catid]" class="form-control custom-select w300" title="">
                            @foreach($categories as $category)
                            <option value="{{$category['pageid']}}"@if($category['pageid']==$page->catid) selected="selected"@endif>{{$category['title']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>模板</td>
                    <td><input type="text" title="" class="form-control w300" name="newpage[template]" value="{{$page['template']}}"></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tr>
                    <td width="60">摘要</td>
                    <td><textarea title="" class="form-control" style="height: 100px;" name="newpage[summary]">{{$page['summary']}}</textarea></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tr>
                    <td width="60">内容</td>
                    <td>
                        <div style="box-sizing:border-box">
                            @include('common.editor', ['name' => 'newpage[content]', 'content'=>$page->content, 'params'=>[]])
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary w100">发布</button></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#Form").on('submit', function () {
            var title = $.trim($("#title").val());
            if (!title){
                DSXUI.error('请填写标题');
                return false;
            }
        });
    </script>
@stop
