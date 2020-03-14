@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">素材管理</li>
        <li class="breadcrumb-item active">素材列表</li>
    </ol>

    <div class="search-container" id="search-container">
        <form method="get" id="searchFrom">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="row">
                <div class="cell">
                    <div class="label">用户ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="uid" value="{{$uid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">用户名:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="username" value="{{$username}}"></div>
                </div>
                <div class="cell">
                    <div class="label">名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="name" value="{{$name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">上传时间:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control w100" name="time_begin" value="{{$time_begin}}" onclick="WdatePicker()"></label>
                        <label class="seperator"> - </label>
                        <label><input type="text" title="" class="form-control w100" name="time_end" value="{{$time_end}}" onclick="WdatePicker()"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="submit" class="btn btn-primary">搜索</button>
                        <button type="button" class="btn btn-default" id="addMaterial">添加素材</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="dsxui-tabs-container">
        <ul class="dsxui-tabs">
            @foreach(trans('material.types') as $k=>$v)
                <li class="tab-item"><a href="{{admin_url('material?type='.$k)}}" class="tab-link{{$k==$type ? ' active' : ''}}">{{$v}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="50" class="center">选?</th>
                    <th width="60">图片</th>
                    <th>名称</th>
                    <th>所属用户</th>
                    <th width="120">大小</th>
                    <th width="150">上传时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $id=>$item)
                    <tr>
                        <td class="center">
                            <input type="checkbox" title="" class="checkmark" name="items[]" value="{{$item['id']}}">
                        </td>
                        <td>
                            @if($type === 'image')
                            <img src="{{image_url($item['thumb'])}}" width="50" height="50">
                            @elseif($type === 'video')
                            <img src="{{asset('images/common/video.png')}}" width="50" height="50">
                            @elseif($type === 'voice')
                            <img src="{{asset('images/common/audio.png')}}" width="50" height="50">
                            @elseif($type === 'doc')
                            <img src="{{asset('images/common/doc.png')}}" width="50" height="50">
                            @else
                            <img src="{{asset('images/common/file.png')}}" width="50" height="50">
                            @endif
                        </td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['user']['username']}}</td>
                        <td>{{format_size($item['size'])}}</td>
                        <td>{{$item['created_at']}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <span class="float-right">{!! $pagination !!}</span>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> {{trans('common.selectall')}}</label>
                            <button type="button" class="btn btn-default" id="delete" disabled="disabled">批量删除</button>
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
                    $("#delete").enable();
                } else {
                    $("#delete").disable();
                }
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选素材吗?', function () {
                    $("#listForm").ajaxSubmit({
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode){
                                    DSXUI.showToast('删除失败');
                                }else {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
    @if($type === 'image')
    <script type="text/javascript">
        $("#addMaterial").on('click', function () {
            Widget.showImagePicker(function () {
                DSXUtil.reFresh();
            });
        });
    </script>
    @endif
@stop
