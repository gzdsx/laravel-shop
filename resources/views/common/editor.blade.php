<textarea title="" name="{{$name??'content'}}" id="kindeditor" style="width:100%; height:{{$height??'400'}}px; visibility:hidden; display:none;">{{$content??''}}</textarea>
<link rel="stylesheet" href="{{asset('kindeditor/themes/default/default.css')}}" />
<script charset="utf-8" src="{{asset('kindeditor/kindeditor-all-min.js?v=1.0')}}"></script>

<script type="text/javascript">
    (function () {
        var keditor = KindEditor.create('#kindeditor', {
            items : [
                'source', '|', 'undo', 'redo', '|', 'template', 'code', 'cut', 'copy', 'paste',
                'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image',
                'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink'
            ],
            afterBlur: function () {this.sync();},
            formatUploadUrl:false,
            allowFileManager : true,
            uploadJson : "{{url('kindeditor/upload')}}",
            fileManagerJson:"{{url('kindeditor/manager')}}",
            extraFileUploadParams:{!! json_encode(editor_params($params??[])) !!}
        });
    })();
</script>
