@extends('layouts.user')

@section('title', '资料设置')

@section('content')
    <div class="console-title">
        <h2>资料设置</h2>
    </div>
    @if ($updated)
        <div class="alert alert-success" role="alert">资料修改成功</div>
    @endif
    <div class="avatar-div">
        <div class="avatar"><img id="avatar-image" src="{{auth()->user()->avatar}}"></div>
        <div class="avatar-content">
            <a id="picker">
                修改头像
            </a>
        </div>
        <div class="avatar-content">支持JPG,JPEG,GIF,PNG格式</div>
    </div>
    <div class="userinfo-div">
        <form method="post" id="Form">
            @csrf
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
                <tr>
                    <td width="64">性别</td>
                    <td>
                        @foreach(trans('user.sex_items') as $k=>$v)
                            <input title="" type="radio" value="{{$k}}" name="userinfo[gender]"@if($k==$userinfo['gender']) checked="checked"@endif> {{$v}}
                        @endforeach
                    </td>
                    <td width="40">生日</td>
                    <td><input title="" type="text" class="form-control w200" name="userinfo[birthday]" onclick="WdatePicker()" value="{{$userinfo['birthday']}}" readonly></td>
                </tr>
                <tr>
                    <td>星座</td>
                    <td>
                        <select title="" class="form-control w200" name="userinfo[star]">
                            @foreach(trans('user.star_items') as $k=>$v)
                                <option value="{{$k}}"@if($k==$userinfo['star']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>血型</td>
                    <td>
                        <select title="" class="form-control w200" name="userinfo[blood]">
                            @foreach(trans('user.blood_items') as $k=>$v)
                                <option value="{{$k}}"@if($k==$userinfo['blood']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>所在地</td>
                    <td colspan="3">
                        <label>
                            <select title="" class="form-control width-auto" id="province" name="userinfo[province]">
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control width-auto" id="city" name="userinfo[city]">
                                <option value="">请选择</option>
                            </select>
                        </label>
                        <label>
                            <select title="" class="form-control width-auto" id="district" name="userinfo[district]">
                                <option value="">请选择</option>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>个人描述</td>
                    <td colspan="3"><textarea title="" name="userinfo[introduction]" class="form-control" draggable="false" style="width:500px; height:80px;">{{$userinfo['introduction']}}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"><button type="submit" class="btn btn-primary w100">更新资料</button></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        (function () {
            new DistrictSelector({
                province:'{{$userinfo['province']}}',
                city:'{{$userinfo['city']}}',
                district:'{{$userinfo['district']}}'
            });
        })();
    </script>
    <link href="{{asset('webuploader/webuploader.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('webuploader/webuploader.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '{{asset('webuploder/Uploader.swf')}}',
            // 文件接收服务端。
            server: "{{url('/user/avatar')}}",
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',
            // 只允许选择图片文件。
            multiple:false,
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,png',
                mimeTypes: 'image/*'
            },
            fileVal:"file",
            formData:{'_token':'{{csrf_token()}}'}
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadStart', function( file, percentage ) {
            DSXUI.showSpinner();
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file , response) {
            setTimeout(function () {
                DSXUI.hideSpinner();
            }, 500);
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file, reason ) {
            alert(JSON.stringify(reason));
        });
    </script>
@stop
