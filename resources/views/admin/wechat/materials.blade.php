@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a id="addMaterial">
                <span class="btn btn-primary">添加素材</span>
            </a>
        </div>
        <h2>微信素材管理</h2>
    </div>
    <div class="toolbar">
        @if($type=='image')
        <span class="f-right">图片不超过2M，支持bmp/png/jpeg/jpg/gif格式</span>
        @elseif($type=='voice')
        <span class="f-right">声音不超过2M，播放长度不超过60s，mp3/wma/wav/amr格式</span>
        @else
        <span class="f-right">视频不超过10MB，支持MP4格式</span>
        @endif
    </div>
    <div class="dsxui-tabs-container">
        <div class="dsxui-tabs">
            @foreach(trans('material.types') as $k=>$v)
            <div class="tab-item"><a href="{{admin_url('wechat/material?type='.$k)}}" class="tab-link{{$type==$k ? ' active' : ''}}">{{$v}}</a></div>
            @endforeach
        </div>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40">选?</th>
                    <th width="50">图片</th>
                    <th width="200">名称</th>
                    <th width="350">media_id</th>
                    <th>URL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkmark mediaid" name="items[]" value="{{$item['media_id']}}"></td>
                    <td>
                        @if($type=='image')
                        <div class="bg-cover asyncload" data-original="{{admin_url('wechat/viewimage?media_id='.$item['media_id'])}}" style="width: 50px; height: 50px;"></div>
                        @elseif ($type=='video')
                        <img src="{{asset('images/common/video.png')}}" width="50" height="50">
                        @else
                        <img src="{{asset('images/common/audio.png')}}" width="50" height="50">
                        @endif
                    </td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['media_id']}}</td>
                    <td>{{$item['url'] ?? ''}}</td>
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
    <script type="text/x-template" id="J-add-video-tpl">
        <div style="padding:20px; display:block;">
            <form method="post" id="J-video-form">
                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td width="40">视频</td>
                        <td><input type="hidden" name="media" id="J-video-media"><input title="" type="text" class="input-text w300" id="J-video-pick" readonly></td>
                        <td class="tips">视频不超过10MB，支持MP4格式<td>
                    </tr>
                    <tr>
                        <td>标题</td>
                        <td><input title="" type="text" class="input-text w300" name="title" id="J-video-title"></td>
                        <td class="tips">标题，不超过30个字<td>
                    </tr>
                    <tr>
                        <td>简介</td>
                        <td><textarea title="" class="textarea w300" name="introduction" id="J-video-introduction"></textarea></td>
                        <td class="tips">视频简介，不超过120个字<td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </script>
@stop

@section('foot')
    @if($type=='image')
        <script type="text/javascript">
            $(function () {
                $("#addMaterial").on('click', function () {
                    Plugins.showImagePicker(function (data) {
                        $.ajax({
                            type:'POST',
                            url:"{{admin_url('weixin/addmaterial')}}",
                            data:{media:data.image, type:'image'},
                            beforeSend: function(){
                                DSXUI.showloading('正在上传素材到微信服务器..');
                            },
                            success: function(response){
                                DSXUI.hideloading();
                                if(response.errcode === 0){
                                    DSXUI.showToast('素材添加失败');
                                }else {
                                    DSXUtil.reFresh();
                                }
                            }
                        });
                    });
                });
            });
        </script>
    @endif
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                $("#batchdelete").enable($(".mediaid:checked").length > 0);
            });
            $("#batchdelete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选素材吗?', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('wechat/material/batchdelete')}}',
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode){
                                    DSXUI.showToast(response.errmsg);
                                }else  {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
@stop
