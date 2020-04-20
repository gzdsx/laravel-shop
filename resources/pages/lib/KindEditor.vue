<template>
    <textarea title="" style="width: 100%; display: none;" :style="{'height':height}"
              id="kindeditor">{{content}}</textarea>
</template>

<script>
    export default {
        name: "KindEditor",
        model: {
            prop: 'modelVal',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            modelVal: {
                type: String,
                default: ''
            },
            height: {
                default: '400px'
            },
            uploadParams: {
                type: Object,
                default: {}
            }
        },
        data: function () {
            return {
                keditor: null,
                content: ''
            }
        },
        mounted() {
            this.initEditor();
        },
        watch: {
            content(val) {
                this.$emit('change', val);
            },
            modelVal(val){
                this.keditor && this.keditor.html(val);
            }
        },
        methods: {
            initEditor: function () {
                var _this = this;
                (function () {
                    _this.keditor = KindEditor.create('#kindeditor', {
                        items: [
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
                            _this.content = _this.keditor.html();
                        },
                        formatUploadUrl: false,
                        allowFileManager: true,
                        uploadJson: "/kindeditor/upload",
                        fileManagerJson: "/kindeditor/manager",
                        extraFileUploadParams: _this.uploadParams
                    });
                })();
            }
        }
    }
</script>

<style scoped>

</style>
