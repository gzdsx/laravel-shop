<template>
    <el-dialog
            :visible="visible"
            title="选择图片"
            @close="handleClose"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
    >
        <el-container style="margin-top: -20px; margin-bottom: 10px;">
            <div class="flex" style="line-height: 32px;">
                图片上传仅支持JPG,JPEG,PNG,GIF格式，大小不能超过5MB
            </div>
            <div class="display-flex" style="align-items: flex-end; text-align: right;">
                <el-upload
                        class="upload-demo"
                        action="/api/material/uploadimg"
                        accept="image/png, image/jpeg, image/jpg, image/gif"
                        :multiple="false"
                        :data="formData"
                        :headers="headers"
                        :show-file-list="false"
                        :on-success="handleUploadSuccess"
                >
                    <el-button size="small" type="primary">点击上传</el-button>
                </el-upload>
            </div>
        </el-container>
        <el-container style="flex-direction: column;" v-loading="loading">
            <div class="flex-row" style="flex-wrap: wrap; height: 410px; margin: 0 -5px;">
                <div class="image-wrapper" v-for="(item,index) in items" :key="index">
                    <el-image
                            @click="handlePicked(item)"
                            :src="item.thumb"
                            fit="cover"
                            style="width: 100%; height: 120px;"
                    ></el-image>
                </div>
            </div>
            <div class="display-flex" v-show="total>pageSize">
                <div class="flex"></div>
                <el-pagination
                        background
                        layout="prev, pager, next"
                        :total="total"
                        :page-size="pageSize"
                        @current-change="handlerPageChange"
                >
                </el-pagination>
                <div class="flex"></div>
            </div>
        </el-container>
    </el-dialog>
</template>

<script>
    export default {
        name: "ImagePicker",
        model: {
            prop: 'show',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            show: {
                type: Boolean,
                default: false
            }
        },
        data() {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            return {
                items: [],
                offset: 0,
                total: 0,
                pageSize: 15,
                visible: false,
                formData: {
                    '_token': token
                },
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                loading: true
            }
        },
        mounted() {
        },
        watch: {
            visible(val) {
                if (val) {
                    if (this.items.length === 0) this.fetchList();
                }
            },
            show(val) {
                this.visible = val;
            }
        },
        methods: {
            fetchList: function () {
                this.loading = true;
                this.$get('/material/batchget', {
                    type: 'image',
                    offset: this.offset,
                    count: this.pageSize
                }).then(response => {
                    const {total, items} = response.result;
                    this.total = total;
                    this.items = items;
                    this.loading = false;
                });
            },
            handleClose() {
                this.visible = false;
                this.$emit('change', false);
            },
            handlerPageChange(page) {
                this.offset = (page - 1) * 15;
                this.fetchList();
            },
            handlePicked(item) {
                this.$emit('confirm', item);
                this.handleClose();
            },
            handleUploadSuccess(response, file, fileList) {
                this.handlePicked(response.image);
                this.fetchList();
            }
        }
    }
</script>

<style scoped>
    .image-wrapper {
        width: 20%;
        max-width: 20%;
        min-width: 20%;
        display: block;
        cursor: pointer;
        flex: 0.2;
        text-align: center;
        padding: 5px;
    }
</style>
