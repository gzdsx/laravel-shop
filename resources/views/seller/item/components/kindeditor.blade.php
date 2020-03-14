<script type="text/html" id="keditor">
    <textarea title="" id="kindeditor" style="width:100%; height:400px; visibility:hidden; display:none;" v-html="html"></textarea>
</script>
<script type="text/javascript">
    Vue.component('kindeditor',{
        template:'#keditor',
        props:{
            uploadprams:{},
            html:'',
        },
        mounted() {
            var $this = this;
            var editor = KindEditor.create('#kindeditor', {
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
                afterBlur: function () {
                    this.sync();
                    $this.$emit('sync', editor.html());
                },
                formatUploadUrl:false,
                allowFileManager : true,
                uploadJson : "{{url('kindeditor/upload')}}",
                fileManagerJson:"{{url('kindeditor/manager')}}",
                extraFileUploadParams:$this.uploadprams
            });
        }
    });
</script>

