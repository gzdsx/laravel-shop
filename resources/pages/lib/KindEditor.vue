<template>
    <textarea title="" style="width: 100%; display: none;" :style="{'height':height}"
              id="kindeditor">{{content}}</textarea>
</template>

<script>
    export default {
        name: "KindEditor",
        model: {
            prop: 'value',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            value: {
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
            value(val) {
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
                            _this.setCookie('keditor_content', _this.content, 10);
                        },
                        formatUploadUrl: false,
                        allowFileManager: true,
                        uploadJson: "/webapi/kindeditor/upload",
                        fileManagerJson: "/webapi/kindeditor/manager",
                        extraFileUploadParams: {
                            ..._this.uploadParams,
                            _token: document.head.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                })();
            },
            setCookie: function (name, value, expiresHours) {
                var cookieString = name + "=" + escape(value);
                //判断是否设置过期时间
                if (expiresHours > 0) {
                    var date = new Date();
                    date.setTime(date.getTime() + expiresHours * 3600 * 1000);
                    cookieString = cookieString + "; expires=" + date.toGMTString();
                }
                document.cookie = cookieString;
            },
            getCookie: function () {
                var strName = 'keditor_content';
                var strCookie = document.cookie.split("; ");
                for (var i = 0; i < strCookie.length; i++) {
                    var strCrumb = strCookie[i].split("=");
                    if (strName === strCrumb[0]) {
                        return strCrumb[1] ? unescape(strCrumb[1]) : null;
                    }
                }
                return null;
            },
            removeCookie: function () {
                this.setCookie('keditor_content', null, 0);
            }
        }
    }
</script>

<style scoped>

</style>
