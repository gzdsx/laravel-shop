@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('pages/newpage?catid='.$catid)}}" role="button">
                <span class="btn btn-primary">添加页面</span>
            </a>
        </div>
        <h2>页面管理</h2>
    </div>

    <div class="dsxui-tabs-container">
        <ul class="dsxui-tabs">
            <li class="tab-item"><a href="{{admin_url('pages')}}" class="tab-link{{$catid ? '' : ' active'}}">全部</a></li>
            @foreach($categories as $category)
            <li class="tab-item"><a href="{{admin_url('pages?catid='.$category['pageid'])}}" class="tab-link{{$catid==$category['pageid'] ? ' active' : ''}}">{{$category['title']}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th>标题</th>
                    <th>别名</th>
                    <th width="80">排序</th>
                    <th width="150">发布时间</th>
                    <th width="150">最后修改</th>
                    <th width="60">编辑</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td><input type="checkbox" class="checkmark" name="delete[]" value="{{$item['pageid']}}"></td>
                    <td><a href="{{page_url($item['pageid'])}}" target="_blank">{{$item['title']}}</a></td>
                    <td>{{$item['alias']}}</td>
                    <td><input type="number" class="form-control w60" name="pages[{{$item['pageid']}}][displayorder]" value="{{$item['displayorder']}}" /></td>
                    <td>{{$item['created_at']}}</td>
                    <td>{{$item['updated_at']}}</td>
                    <td><a href="{{admin_url('pages/newpage?pageid='.$item['pageid'])}}">编辑</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <span class="float-right">{!! $pagination !!}</span>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-primary" id="submitButton">提交</button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#submitButton").on('click', function () {
            if ($(".checkmark:checked").length > 0) {
                DSXUI.showConfirm('你确认要删除所选页面吗?', function () {
                    $("#listForm").submit();
                });
            } else {
                $("#listForm").submit();
            }
        });
    </script>
@stop
