@extends('layouts.admin')

@section('title', '商品管理')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">商品管理</li>
        <li class="breadcrumb-item active">商品评论</li>
    </ol>

    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkmark" data-action="checkall"></th>
                    <th width="80">图片</th>
                    <th>商品</th>
                    <th>买家</th>
                    <th>评论</th>
                    <th>追加</th>
                    <th width="140">评论时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$item['id']}}"></td>
                    <td><div class="bg-cover" style="background-image: url({{image_url($item['item']['thumb'])}}); width: 60px; height: 60px;"></div></td>
                    <td>{{$item['item']['title']}}</td>
                    <td>{{$item['user']['username']}}</td>
                    <td>{{$item['message']}}</td>
                    <td>{{$item['add_message']}}</td>
                    <td>{{@date('Y-m-d H:i:s', $item['created_at'])}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="pagination float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label class="form-check-label"><input type="checkbox" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="delete">批量删除</button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选评论吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('item/delreviews')}}',
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
@stop
