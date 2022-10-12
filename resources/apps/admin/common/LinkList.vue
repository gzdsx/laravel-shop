<template>
    <div>
        <header class="page-header">
            <div class="page-title">链接管理</div>
        </header>

        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <el-tabs
                            @tab-click="onClickTab"
                            @tab-remove="onRemoveTab"
                    >
                        <el-tab-pane
                                v-for="(cate,index) in categoryList"
                                :label="cate.title"
                                :name="cate.id.toString()"
                                :key="index"
                        ></el-tab-pane>
                    </el-tabs>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="small" @click="showDialog=true">添加链接</el-button>
                    </div>
                </div>
                <el-table :data="dataList" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column label="图片" width="70">
                        <template slot-scope="scope">
                            <el-image class="img-50" fit="cover" :src="scope.row.image"
                                      @click="onChangeImage(scope.row)"/>
                        </template>
                    </el-table-column>
                    <el-table-column prop="title" label="网站名称">
                        <template slot-scope="scope">
                            <a :href="scope.row.url" target="_blank">{{scope.row.title}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="url" label="链接"/>
                    <el-table-column label="编辑" width="60">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                </div>
            </div>
        </div>
        <el-dialog :visible.sync="showDialog" width="35%" title="编辑链接" :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col class="w80">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td>网站名称</td>
                    <td>
                        <el-input v-model="link.title" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>网站链接</td>
                    <td>
                        <el-input v-model="link.url" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                <tr>
                    <td>显示顺序</td>
                    <td>
                        <el-input v-model="link.sort_num" size="medium" class="w300"></el-input>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button size="medium" type="primary" @click="onSubmit" class="w100">确 定</el-button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
        <image-picker v-model="showPicker" @confirm="onChooseImage"/>
    </div>
</template>

<script>
    export default {
        name: "LinkList",
        data() {
            return {
                cate_id: 0,
                link: {},
                dataList: [],
                categoryList: [
                    {
                        id: 0,
                        title: '全部'
                    }
                ],
                selectionIds: [],
                showDialog: false,
                showPicker: false
            }
        },
        mounted() {
            this.fetchList();
            this.fetchCategoryList();
        },
        methods: {
            fetchList() {
                let {cate_id} = this;
                this.$get('/common/link.getList', {cate_id}).then(response => {
                    this.dataList = response.result.items;
                });
            },
            fetchCategoryList() {
                this.$get('/common/link.getCategoryList').then(response => {
                    this.categoryList = this.categoryList.concat(response.result.items);
                });
            },
            onSelectionChange(val) {
                this.selectionIds = val;
            },
            onDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选链接, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/common/link.batchDelete', {ids}).then(response => {
                        this.fetchList();
                    });
                });
            },
            onShowEdit(link) {
                this.link = link;
                this.showDialog = true;
            },
            onSubmit() {
                let {link} = this;
                let {id} = link;

                if (!link.title) {
                    this.$showToast('请填写网站名称');
                    return false;
                }

                if (!link.url) {
                    this.$showToast('请填写网站链接');
                    return false;
                }

                this.$post('/common/link.save', {id, link}).then(response => {
                    this.$showToast('链接保存成功');
                    this.showDialog = false;
                    this.fetchList();
                });
            },
            onChangeImage(link) {
                this.link = link;
                this.showPicker = true;
            },
            onChooseImage(data) {
                this.$post('/common/link.save', {
                    id: this.link.id,
                    link: {image: data.image}
                }).then(() => {
                    this.fetchList();
                });
            },
            onClickTab(t) {
                this.cate_id = t.name;
                this.fetchList();
            },
            onRemoveTab(t) {

            },
        }
    }
</script>

<style scoped>

</style>
