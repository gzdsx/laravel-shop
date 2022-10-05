<textarea title="" name="{{$name??'content'}}" id="kindeditor" style="width:100%; height:{{$height??'400'}}px; visibility:hidden; display:none;">{{$content??''}}</textarea>
<link rel="stylesheet" href="{{asset('kindeditor/themes/default/default.css?v=1.1')}}" />
<script charset="utf-8" src="{{asset('kindeditor/kindeditor-all-min.js?v=1.1')}}"></script>

<script type="text/javascript">
    (function () {
        var keditor = KindEditor.create('#kindeditor', {
            formatUploadUrl:false,
            allowFileManager : true,
            uploadJson : "{{url('kindeditor/upload')}}",
            fileManagerJson:"{{url('kindeditor/manager')}}",
            extraFileUploadParams:{}
        });
    })();
</script>
