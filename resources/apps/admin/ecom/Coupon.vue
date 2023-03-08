<template>
    <div>
        <header class="page-header">
            <div class="page-title flex-fill">优惠券管理</div>
        </header>
        <div class="mainframe-content">
            <div class="content-block">
                <div class="table-edit-header">
                    <div class="table-edit-title">模板列表</div>
                    <div class="buttons-wrapper">
                        <el-button type="primary" size="small" @click="onShowAdd">添加优惠券</el-button>
                    </div>
                </div>

                <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                    <el-table-column width="45" type="selection"/>
                    <el-table-column prop="title" label="模板名称" width="200"/>
                    <el-table-column prop="value" label="面值" width="100"/>
                    <el-table-column prop="description" label="描述"/>
                    <el-table-column prop="validity_range" label="有效期"/>
                    <el-table-column prop="per_limit" label="每人限领(张)" width="120" align="center"/>
                    <el-table-column prop="used_count" label="已使用数量" width="120" align="center"/>
                    <el-table-column prop="state_des" label="状态" width="120" align="center"/>
                    <el-table-column width="80" label="操作选项" align="right">
                        <template slot-scope="scope">
                            <a @click="onShowEdit(scope.row)">编辑</a>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="table-edit-footer">
                    <el-button size="small" type="primary" :disabled="selectionIds.length === 0" @click="onBatchDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({state:1})">批量启用
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length === 0"
                               @click="onBatchUpdate({state:0})">批量停用
                    </el-button>
                    <div class="flex"></div>
                    <el-pagination
                            background
                            layout="prev, pager, next,total"
                            :total="total"
                            :page-size="pageSize"
                            :current-page="page"
                            @current-change="onPageChange"
                    >
                    </el-pagination>
                </div>
            </div>
        </div>
        <el-dialog title="编辑信息" closeable
                   :visible.sync="showDialog"
                   :close-on-click-modal="false"
                   :close-on-press-escape="false">
            <table class="dsxui-formtable">
                <colgroup>
                    <col style="width: 80px;">
                    <col style="width: 300px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <td class="cell-label">名称</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="coupon.title"/>
                    </td>
                    <td class="cell-tips">优惠券名称</td>
                </tr>
                <tr>
                    <td class="cell-label">类型</td>
                    <td class="cell-input">
                        <el-radio-group v-model="coupon.type">
                            <el-radio :label="1">满减</el-radio>
                            <el-radio :label="2">按比例折扣</el-radio>
                        </el-radio-group>
                    </td>
                    <td class="cell-tips">优惠券类型</td>
                </tr>
                <tr>
                    <td class="cell-label">面值</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="coupon.value"/>
                    </td>
                    <td class="cell-tips">
                        满减券填写满减金额，折扣券请填写折扣比例
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">使用限额</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="coupon.min_amount"/>
                    </td>
                    <td class="cell-tips">
                        消费达到多少金额可以使用，不限金额请填0
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">每人限领</td>
                    <td class="cell-input">
                        <el-input size="medium" v-model="coupon.per_limit"/>
                    </td>
                    <td class="cell-tips">
                        每人可以领取的限额，不限请填0
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">生效时间</td>
                    <td class="cell-input">
                        <el-date-picker
                                v-model="coupon.start_at"
                                type="datetime"
                                placeholder="选择日期时间"
                                value-format="yyyy-MM-dd HH:mm"
                                format="yyyy-MM-dd HH:mm"
                                size="medium"
                                class="w300"
                                clearable
                        />
                    </td>
                    <td class="cell-tips">不限时间请留空</td>
                </tr>
                <tr>
                    <td class="cell-label">过期时间</td>
                    <td class="cell-input">
                        <el-date-picker
                                v-model="coupon.end_at"
                                type="datetime"
                                placeholder="选择日期时间"
                                value-format="yyyy-MM-dd HH:mm"
                                format="yyyy-MM-dd HH:mm"
                                size="medium"
                                class="w300"
                                clearable
                        />
                    </td>
                    <td class="cell-tips">不限时间请留空</td>
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
    </div>
</template>

<script>
    import PaginationMixin from "../mixins/PaginationMixin";

    export default {
        name: "Coupon",
        data() {
            return {
                coupon: {},
                showDialog: false,
                listApi: '/ecom/coupon.getList'
            }
        },
        mixins: [PaginationMixin],
        methods: {
            resetData() {
                this.coupon = {id: 0, type: 1, min_amount: 200, per_limit: 1};
            },
            onSubmit() {
                let {coupon} = this;
                if (!coupon.title) {
                    this.$showToast('请填写名称');
                    return false;
                }
                if (!coupon.value) {
                    this.$showToast('请填写面值');
                    return false;
                }

                this.$post('/ecom/coupon.save', {coupon}).then(() => {
                    this.showDialog = false;
                    this.fetchList();
                });
            },
            onShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            onShowEdit(d) {
                this.coupon = d;
                this.showDialog = true;
            },
            onBatchDelete() {
                let ids = this.selectionIds.map((d) => d.id);
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$post('/ecom/coupon.batchDelete', {ids}).then(() => {
                        this.fetchList();
                    });
                });
            },
            onBatchUpdate(data) {
                let ids = this.selectionIds.map((d) => d.id);
                this.$post('/ecom/coupon.batchUpdate', {ids, data}).then(() => {
                    this.fetchList();
                });
            }
        },
        mounted() {
            this.fetchList();
        },
    }
</script>

<style scoped>

</style>
