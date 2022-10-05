<template>
    <textarea style="width: 100%; display: none;" :style="{'height':height}" :id="id"></textarea>
</template>

<script>
    export default {
        name: "KindEditor",
        model: {
            prop: 'value',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            value: '',
            height: {
                default: '400px'
            },
            uploadParams: {},
            id: {
                type: String,
                default: 'keditor'
            },
        },
        data() {
            return {
                keditor: null
            }
        },
        mounted() {
            this.initEditor();
            //console.log('value',this.value);
        },
        watch: {
            value(val) {
                this.keditor && this.keditor.html(val);
                //console.log(val);
            }
        },
        methods: {
            initEditor() {
                var _this = this;
                this.keditor = KindEditor.create('#'+this.id, {
                    afterBlur() {
                        _this.value = _this.keditor.html();
                        _this.setCookie('keditor_content', _this.value, 10);
                        _this.$emit('change', _this.value);
                    },
                    formatUploadUrl: false,
                    allowFileManager: true,
                    uploadJson: "/api/kindeditor/upload",
                    fileManagerJson: "/api/kindeditor/manager",
                    extraFileUploadParams: {
                        ..._this.uploadParams,
                        _token: _this.$csrfToken
                    }
                });
                this.keditor.html(this.value);
            },
            setCookie(name, value, expiresHours) {
                var cookieString = name + "=" + escape(value);
                //判断是否设置过期时间
                if (expiresHours > 0) {
                    var date = new Date();
                    date.setTime(date.getTime() + expiresHours * 3600 * 1000);
                    cookieString = cookieString + "; expires=" + date.toGMTString();
                }
                document.cookie = cookieString;
            },
            getCookie() {
                var strName = 'keditor_content';
                var strCookie = document.cookie.split("; ");
                for (var i = 0; i < strCookie.length; i++) {
                    var strCrumb = strCookie[i].split("=");
                    if (strName === strCrumb[0]) {
                        return strCrumb[1] ? unescape(strCrumb[1]) : null;
                    }
                }
                return '';
            },
            removeCookie() {
                this.setCookie('keditor_content', '', 0);
            }
        }
    }
</script>

<style scoped>

</style>
