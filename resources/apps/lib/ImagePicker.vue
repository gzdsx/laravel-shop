<template>
    <el-dialog
            :visible="visible"
            title="选择图片"
            @close="onClose"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
    >
        <div class="image-picker">
            <el-container class="image-picker-header">
                <div class="image-picker-tips">
                    <span>图片上传仅支持JPG,JPEG,PNG,GIF格式，大小不能超过5MB</span>
                </div>
                <el-upload
                        accept="image/png, image/jpeg, image/jpg, image/gif"
                        :action="api"
                        :multiple="true"
                        :data="params"
                        :headers="headers"
                        :show-file-list="false"
                        :on-success="onUploadSuccess"
                        :on-error="onUploadError"
                        :before-upload="onBeforeUpload"
                >
                    <el-button size="small" type="primary">点击上传</el-button>
                </el-upload>
            </el-container>
            <el-container direction="vertical" class="image-picker-body" v-loading="loading">
                <div class="image-picker-list">
                    <div class="list-item" v-for="(item,index) in dataList" :key="index" @click="onChooseImage(item)">
                        <div class="image-wrapper">
                            <el-image
                                    :src="item.thumb"
                                    fit="cover"
                                    style="width: 100%; height: 120px;"
                            />
                            <div class="image-mask" v-if="hasImage(item)">
                                <i class="el-icon-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-fill"></div>
                <div class="display-flex" v-if="total>pageSize">
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
                    <div class="flex"></div>
                </div>
            </el-container>
            <el-container v-if="multiple">
                <div class="flex-fill"></div>
                <el-button size="small" @click="onClose">取消</el-button>
                <el-button size="small" type="primary" @click="onConfirm">确定</el-button>
            </el-container>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        name: "ImagePicker",
        model: {
            prop: 'visible',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            visible: {
                type: Boolean,
                default: false
            },
            params: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            multiple: {
                type: Boolean,
                default: false
            },
            maxCount: {
                type: Number,
                default: 15
            }
        },
        data() {
            return {
                dataList: [],
                page: 1,
                total: 0,
                pageSize: 15,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                loading: true,
                uploadedCount: 0,
                results: [],
                api: null,
            }
        },
        watch: {
            visible(val) {
                if (val) {
                    if (this.dataList.length === 0) this.fetchList();
                }
            }
        },
        methods: {
            fetchList() {
                this.loading = true;
                let {page, pageSize} = this;
                let offset = (page - 1) * pageSize;
                this.$get('/common/material.getList', {
                    type: 'image',
                    offset,
                    count: pageSize
                }).then(response => {
                    const {total, items} = response.result;
                    this.total = total;
                    this.dataList = items;
                    this.loading = false;
                });
            },
            onClose() {
                this.$emit('change', false);
            },
            onPageChange(page) {
                this.page = page;
                this.fetchList();
            },
            onChooseImage(image) {
                if (this.multiple) {
                    let index = this.results.indexOf(image);
                    if (index === -1) {
                        if (this.results.length < this.maxCount) {
                            this.results.push(image);
                        }
                    } else {
                        this.results.splice(index, 1);
                    }
                } else {
                    this.$emit('confirm', image);
                    this.onClose();
                }
            },
            onBeforeUpload() {
                this.loading = true;
            },
            onUploadSuccess(response, file, fileList) {
                this.uploadedCount++;
                if (this.uploadedCount === fileList.length) {
                    this.page = 1;
                    this.fetchList();
                }
            },
            onUploadError(err) {
                console.log(err);
            },
            onConfirm() {
                this.$emit('confirm', this.results);
                this.results = [];
                this.onClose();
            },
            hasImage(image) {
                return this.results.indexOf(image) !== -1;
            }
        },
        mounted() {
            let token = document.head.querySelector('meta[name="csrf-token"]').content;
            if (token) {
                this.headers['X-CSRF-TOKEN'] = token;
            } else {
                this.headers['Authorization'] = 'Bearer ' + localStorage.getItem('accessToken');
            }

            this.api = this.$getApi('/common/material.upload?type=image');
        },
    }
</script>

<style scoped>

</style>
