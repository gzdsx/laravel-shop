<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>图片选择器</title>
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/widget/index.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('webuploader/webuploader.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
    <script src="{{asset('webuploader/webuploader.min.js')}}" type="text/javascript"></script>
</head>
<body>
<!--<div class="side-bar">-->

<!--</div>-->
<div class="main-frame" id="app">
    <div class="frame-header">
        <div class="float-right" id="picker">选择图片</div>
    </div>
    <div class="content" v-if="items.length > 0">
        <div class="image-list">
            <ul>
                <li v-for="item in items" :key="item.id">
                    <div class="con" @click="pickImage(item)">
                        <div class="img bg-cover" :style="{'background-image':'url('+item.thumb+')'}"></div>
                    </div>
                </li>
            </ul>
        </div>
        <nav>
            <div class="float-right">{!! $pagination !!}</div>
        </nav>
    </div>
</div>
<script type="text/javascript">var items=@json($items);</script>
<script type="text/javascript">
    var app = new Vue({
        el:'#app',
        data:{
            items:items
        },
        methods:{
            pickImage:function (item) {
                if (window.parent.onPickedImage){
                    window.parent.onPickedImage(item);
                }
            }
        }
    });

    (function () {
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '{{asset('webuploder/Uploader.swf')}}',
            // 文件接收服务端。
            server: "{{url('material/uploadimg')}}",
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id:'#picker',
                multiple:false,
            },
            // 只允许选择图片文件。
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
                if (window.parent.onPickedImage){
                    window.parent.onPickedImage(response.image);
                }
            }, 500);
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file, reason ) {
            console.log(reason);
        });
    })();
</script>
</body>
</html>
