<template>
    <el-dialog
            title="选择媒体文件"
            class="media-dialog"
            top=""
            @close="onClose"
            :visible="visible"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
    >
        <el-tabs v-model="tab">
            <el-tab-pane name="uploader" label="上传文件">
                <el-upload
                        class="media-uploader"
                        drag
                        :multiple="true"
                        :show-file-list="false"
                        :on-success="onUploadSuccess"
                        :on-error="onUploadError"
                        :on-change="onUploadChange"
                        :http-request="onUpload"
                >
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">
                        <p>将文件拖到此处，或</p>
                        <p>
                            <el-button type="primary" plain="true">选择文件</el-button>
                        </p>
                        <p>
                            <small>最大上传文件大小：500MB</small>
                        </p>
                    </div>
                </el-upload>
            </el-tab-pane>
            <el-tab-pane name="media" label="媒体库">
                <div class="media-flexbox">
                    <div class="media-container">
                        <ul class="media-list">
                            <li v-for="(media,index) in uploadFileList" :key="index">
                                <div class="thumbnail" @click="onChooseMedia(media)" v-if="media.id">
                                    <img :src="media.thumb" alt="">
                                    <div class="media-mask" v-if="hasMedia(media)">
                                        <i class="el-icon-success"></i>
                                    </div>
                                </div>
                                <div class="thumbnail" v-else>
                                    <el-progress
                                            color="#409EFF"
                                            define-back-color="#ccc"
                                            stroke-width="20"
                                            :show-text="false"
                                            :percentage="media.percentage"/>
                                </div>
                            </li>
                            <li v-for="media in dataList" :key="media.id">
                                <div class="thumbnail" @click="onChooseMedia(media)">
                                    <img :src="media.thumb" alt="">
                                    <div class="media-mask" v-if="hasMedia(media)">
                                        <i class="el-icon-success"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="el-loading-spinner media-loading" v-if="loading">
                            <svg viewBox="25 25 50 50" class="circular">
                                <circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
                            </svg>
                        </div>
                        <div class="media-loadmore" v-if="!loading">
                            <p>显示 {{ total }} 个中的 {{ dataList.length }} 个媒体项目</p>
                            <div v-if="dataList.length<total">
                                <el-button type="primary" size="small" @click="onLoadMore">加载更多</el-button>
                            </div>
                        </div>
                    </div>
                    <div class="media-editing">
                        <div v-if="currentMedia.id">
                            <h2>附件详情</h2>
                            <img :src="currentMedia.thumb" class="media-preview" alt="">
                            <p><strong>{{ currentMedia.name }}</strong></p>
                            <p>{{ currentMedia.created_at }}</p>
                            <p>{{ currentMedia.formated_size }}</p>
                            <p>{{ currentMedia.url }}</p>

                            <el-button
                                    size="small"
                                    v-clipboard:copy="currentMedia.url"
                                    v-clipboard:success="onCopy"
                            >复制URL地址
                            </el-button>
                        </div>
                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
        <div class="dialog-footer">
            <el-button
                    type="primary"
                    size="small"
                    :disabled="selectedFiles.length===0||tab==='uploader'"
                    @click="onConfirm"
            >使用选中素材
            </el-button>
        </div>
    </el-dialog>
</template>

<script>
export default {
    name: "MediaDialog",
    model: {
        prop: 'visible',//指向props的参数名
        event: 'change'//事件名称
    },
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        maxCount: {
            type: Number,
            default: 15
        },
        options: {
            type: Object,
            default: {
                type: 'image'
            }
        }
    },
    data() {
        return {
            tab: 'media',
            dataList: [],
            offset: 0,
            pageSize: 48,
            total: 0,
            loading: true,
            uploadedCount: 0,
            selectedFiles: [],
            currentMedia: {},
            loadingService: null,
            isLoadMore: false,
            uploadFileList: []
        }
    },
    computed: {},
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
            let {offset, pageSize, options} = this;
            this.$get('/materials', {
                ...options,
                offset,
                count: pageSize
            }).then(response => {
                const {total, items} = response.result;
                this.total = total;
                if (this.isLoadMore) {
                    this.dataList = this.dataList.concat(items);
                } else {
                    this.dataList = items;
                }
            }).catch(reason => {
                this.$message({
                    type: 'error',
                    message: reason.errMsg
                });
            }).then(() => {
                this.loading = false;
            });
        },
        onClose() {
            this.$emit('change', false);
        },
        onUploadChange() {
            this.tab = "media";
        },
        onUpload(e) {
            const file = e.file;
            this.uploadFileList.unshift(file);
            const formData = new FormData();
            formData.append('file', e.file);

            Object.keys(this.options).forEach(key => {
                formData.append(key, this.options[key]);
            });

            return this.$post('/material/upload', formData, {
                timeout: 0,
                headers: {'Content-type': 'multipart/form-data'},
                onUploadProgress: evt => {
                    file.percentage = (evt.loaded / evt.total) * 100;
                    this.uploadFileList.map((data, index) => {
                        if (data.uid === file.uid) {
                            this.uploadFileList.splice(index, 1, file);
                        }
                    });
                }
            });
        },
        onUploadSuccess(response, file, fileList) {
            this.uploadFileList.map((data, index) => {
                if (data.uid === file.uid) {
                    this.uploadFileList.splice(index, 1, response.result);
                }
            });
        },
        onUploadError(err) {
            this.$message.error(err.message);
        },
        onConfirm() {
            if (this.multiple) {
                this.$emit('confirm', this.selectedFiles);
            } else {
                this.$emit('confirm', this.selectedFiles[0]);
            }

            this.selectedFiles = [];
            this.onClose();
        },
        hasMedia(file) {
            return this.selectedFiles.indexOf(file) !== -1;
        },
        onChooseMedia(file) {
            if (this.multiple) {
                let index = this.selectedFiles.indexOf(file);
                if (index === -1) {
                    if (this.selectedFiles.length < this.maxCount) {
                        this.selectedFiles.push(file);
                    }
                } else {
                    this.selectedFiles.splice(index, 1);
                }
            } else {
                this.selectedFiles = [file];
            }

            var len = this.selectedFiles.length;
            if (len > 0) {
                this.currentMedia = this.selectedFiles[len - 1];
            } else {
                this.currentMedia = {};
            }
        },
        onLoadMore() {
            if (this.dataList.length < this.total) {
                this.offset += this.pageSize;
                this.isLoadMore = true;
                this.fetchList();
            }
        },
        formatSize(size) {
            if (size > 1048576) {
                return (size / 1048576).toFixed(2) + 'MB';
            }
            return (size / 1024).toFixed(2) + 'KB';
        },
        onCopy() {
            this.$message.success('地址复制成功');
        }
    },
    mounted() {

    },
}
</script>

<style scoped>

</style>
