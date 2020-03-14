@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>微信管理->图文消息管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="20" class="center">选?</th>
                    <th width="50">图片</th>
                    <th width="300">标题</th>
                    <th width="340">media_id</th>
                    <th width="110">创建时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$item['media_id']}}"></td>
                    <td><div class="bg-cover asyncload" data-original="{{admin_url('wechat/viewimage?media_id='.$item['content']['news_item'][0]['thumb_media_id'])}}" style="width: 50px; height: 50px;"></div></td>
                    <td>{{$item['content']['news_item'][0]['title']}}</td>
                    <td>{{$item['media_id']}}</td>
                    <td>{{@date('Y-m-d H:i:s', $item['update_time'])}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" class="btn-group-sm">
                        <div class="float-right">{!! $pagination !!}</div>
                        <label><input type="checkbox" data-action="checkall"> {{trans('common.selectall')}}</label>
                        <button type="button" class="btn btn-default" id="batchdelete" disabled="disabled">批量删除</button>
                        <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
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
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0){
                    $("#batchdelete").enable();
                } else {
                    $("#batchdelete").disable();
                }
            });
            $("#batchdelete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选素材吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('wechat/material/batchdelete')}}',
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
