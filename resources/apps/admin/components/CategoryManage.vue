<template>
    <main-layout>
        <div class="d-flex" slot="header">
            <h2 class="flex-grow-1">分类管理</h2>
            <div>
                <el-button type="primary" size="small" @click="onShowAdd">添加分类</el-button>
            </div>
        </div>
        <section class="page-section">
            <table class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="50">ID</th>
                    <th width="50">图标</th>
                    <th>名称</th>
                    <th width="100">排序</th>
                    <th width="200" class="text-right">选项</th>
                </tr>
                </thead>
            </table>
            <category-list-table
                    :categories="categories"
                    :level="0"
                    :on-edit="onShowEdit"
                    :on-delete="onDelete"
                    :on-add-child="onAddChild"
                    :on-increase="onIncrease"
                    :on-decrease="onDecrease"
            />
        </section>
        <el-dialog title="编辑分类"
                   closeable
                   :visible.sync="showDialog"
                   :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 350px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">图片</td>
                    <td class="cell-input">
                        <div class="img-80" @click="showMediaDialog=true">
                            <el-image :src="category.image" fit="cover" class="img-80" v-if="category.image"></el-image>
                            <div class="img-80 img-placeholder" v-else></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.name"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">别名</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.slug"/>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">上级分类</td>
                    <td class="cell-input">
                        <el-cascader
                                v-model="category.parent_id"
                                :options="nodes"
                                size="medium"
                                class="w-100"
                                :clearable="true"
                                style="height: 36px;"
                                @change="onSascaderChange"
                                @clear="category.parent_id=0"
                        ></el-cascader>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="cell-label">显示顺序</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="category.sort_num"></el-input>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">描述</td>
                    <td class="cell-input">
                        <el-input type="textarea" rows="6" v-model="category.description"/>
                    </td>
                    <td class="cell-tips">100个字以内</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <el-button type="primary" size="medium" class="w100" @click="onSubmit">提交</el-button>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </el-dialog>
        <media-dialog v-model="showMediaDialog" :options="{type:'image'}" @confirm="onChooseImage"/>
    </main-layout>
</template>

<script>
import CategoryService from "../utils/CategoryService";
import CategoryListTable from "./CategoryListTable";
import CategoryOptionList from "./CategoryOptionList";

export default {
    name: "CategoryManage",
    components: {CategoryOptionList, CategoryListTable},
    props: {
        taxonomy: {
            type: String,
            default: 'post'
        }
    },
    data() {
        return {
            categories: [],
            category: {},
            showDialog: false,
            showMediaDialog: false,
            nodes: []
        }
    },
    watch: {},
    methods: {
        fetchList() {
            let {taxonomy} = this;
            CategoryService.listCategories({taxonomy}).then(response => {
                this.categories = response.result.items;
                this.nodes = this.serilazeProps(this.categories);
            });
        },
        onShowEdit(c) {
            console.log(c);
            this.category = c;
            this.showDialog = true;
            this.nodes = this.serilazeProps(this.categories);
        },
        onShowAdd() {
            this.category = {
                parent_id: 0,
                sort_num: 0
            }
            this.showDialog = true;
        },
        onDelete(id) {
            this.$confirm('确定要删除此分类码?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                CategoryService.deleteCategory([id]).then(() => {
                    this.fetchList();
                });
            });
        },
        onAddChild(id) {
            this.category = {
                parent_id: id,
                sort_num: 0
            }
            this.showDialog = true;
        },

        onIncrease(id) {
            CategoryService.increase(id).then(() => {
                this.fetchList();
            });
        },
        onDecrease(id) {
            CategoryService.decrease(id).then(() => {
                this.fetchList();
            });
        },
        onSascaderChange(arr) {
            if (arr.length > 0) this.category.parent_id = arr[arr.length - 1];
        },
        onSubmit() {
            let {category} = this;
            if (!category.name) {
                this.$message.error('请填写分类名称');
                return false;
            }
            CategoryService.storeCategory(this.category).then(() => {
                this.fetchList();
                this.showDialog = false;
                this.$message.success(category.cate_id ? '分类已更新' : '分类已保存');
            });
        },
        onChooseImage(media) {
            this.category.image = media.url;
        },
        serilazeProps(arr) {
            let that = this;

            function t(a) {
                return a.map(function (c) {
                    var obj = {
                        value: c.cate_id,
                        label: c.name,
                        disabled: c.cate_id === that.category.cate_id
                    };
                    if (c.children.length > 0) {
                        obj.children = t(c.children);
                    }
                    return obj;
                });
            }

            return t(arr);
        },
    },
    mounted() {
        this.fetchList();
    }
}
</script>

<style scoped>

</style>