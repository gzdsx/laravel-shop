<template>
    <div>
        <div :id="id">
            <div ref="toolbar" class="we-toolbar"></div>
            <div class="we-container">
                <div class="w-text-container" :style="{'height':height+'px'}">
                    <div ref="editor"></div>
                </div>
            </div>
        </div>
        <image-picker v-model="showPicker" :multiple="true" @confirm="insertImage"></image-picker>
    </div>

</template>

<script>
    import {API_URL} from "../../js/config";

    export default {
        name: "VueEditor",
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
                type: Number,
                default: 450
            },
            id: {
                type: String,
                default: 'vueeditor'
            },
        },
        data() {
            return {
                editor: null,
                showPicker: false,
                content: this.value
            }
        },
        mounted() {
            this.initEditor();
            this.editor.txt.html(this.value);
        },
        watch: {
            value(val) {
                if (val != this.editor.txt.html()) {
                    this.editor.txt.html(val);
                }
            }
        },
        methods: {
            initEditor() {
                let _this = this;
                this.editor = new window.wangEditor(this.$refs.toolbar, this.$refs.editor);
                this.editor.config.zIndex = 0;
                this.editor.config.uploadImgServer = API_URL + '/material/upload/image';
                this.editor.config.uploadImgMaxSize = 3 * 1024 * 1024; // 3M
                this.editor.config.uploadImgAccept = ['jpg', 'jpeg', 'png', 'gif'];
                this.editor.config.uploadImgParams = {
                    _token: this.$csrfToken
                }
                this.editor.config.uploadFileName = 'file';
                this.editor.config.customInsertImage = function (e) {
                    _this.showPicker = true;
                }
                // 配置 onchange 回调函数
                this.editor.config.onchange = function (html) {
                    //console.log('change 之后最新的 html', html)
                    _this.content = html;
                    _this.$emit('change', html);
                }
                this.editor.create();
            },
            insertImage(images) {
                for (let img of images){
                    this.editor.cmd.do('insertHTML', `<img src="${img.image}" style="max-width:100%;"/>`);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .we-toolbar {
        background-color: #FFF;
        border: 1px solid #c9d8db;
        border-bottom: 1px solid #EEE;
    }

    .we-container {
        border: 1px solid #c9d8db;
        border-top: none;
    }

    .w-text-container {
        min-height: 400px !important;
        overflow-y: auto;

        * {
            max-width: 100% !important;
        }

        .w-e-text-container {
            border: none !important;
            padding: 20px;
        }

        .w-e-text {
            box-sizing: border-box;
            * {
                max-width: 100% !important;
            }
        }
    }
</style>
