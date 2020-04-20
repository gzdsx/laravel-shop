<template>
    <el-dialog
            :visible="visible"
            title="选择图片"
            @close="handleClose"
    >
        <el-container style="margin-top: -20px;">
            <div class="flex" style="line-height: 32px;">
                图片上传仅支持JPG,JPEG,PNG,GIF格式，大小不能超过5MB
            </div>
            <div class="display-flex" style="align-items: flex-end; text-align: right;">
                <el-upload
                        class="upload-demo"
                        action="/webapi/material/uploadimg"
                        accept="image/png, image/jpeg, image/jpg, image/gif"
                        :multiple="false"
                        :data="formData"
                        :show-file-list="false"
                        :on-success="handleUploadSuccess"
                >
                    <el-button size="small" type="primary">点击上传</el-button>
                </el-upload>
            </div>
        </el-container>
        <el-container style="flex-wrap: wrap;">
            <div class="image-wrapper" v-for="(item,index) in itemList" :key="index">
                <el-image
                        @click="handlePicked(item)"
                        :src="item.thumb"
                        fit="cover"
                        style="width: 120px; height: 120px;"
                ></el-image>
            </div>
        </el-container>
        <div class="display-flex">
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
    </el-dialog>
</template>

<script>
    export default {
        name: "ImagePicker",
        model: {
            prop: 'modelVal',//指向props的参数名
            event: 'change'//事件名称
        },
        props: {
            modelVal: {
                type: Boolean,
                default: false
            }
        },
        data: function () {
            return {
                itemList: [],
                offset: 0,
                total: 0,
                pageSize: 15,
                visible: false,
                formData: {
                    '_token': document.head.querySelector('meta[name="csrf-token"]').content
                }
            }
        },
        mounted() {
        },
        watch: {
            visible(val) {
                if (val) {
                    if (this.itemList === undefined || this.itemList.length === 0)
                    this.fetchList();
                }
                this.$emit('change', val);
            },
            modelVal(val) {
                this.visible = val;
            }
        },
        methods: {
            fetchList: function () {
                this.$axios.get('/webapi/material/batchget', {
                    params: {
                        type: 'image',
                        offset: this.offset,
                        count: this.pageSize
                    }
                }).then(response => {
                    this.total = response.data.total;
                    this.itemList = response.data.items;
                });
            },
            handleClose: function () {
                this.visible = false;
            },
            handlerPageChange: function (page) {
                this.offset = (page - 1) * 15;
                this.fetchList();
            },
            handlePicked: function (item) {
                this.$emit('confirm', item);
                this.handleClose();
            },
            handleUploadSuccess: function (response, file, fileList) {
                this.handlePicked(response.image);
                this.fetchList();
            }
        }
    }
</script>

<style scoped>
    .image-wrapper {
        margin-bottom: 10px;
        align-items: center;
        justify-content: center;
        width: 20%;
        max-width: 20%;
        min-width: 20px;
        display: flex;
        cursor: pointer;
    }
</style>
