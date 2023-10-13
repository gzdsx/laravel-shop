<template>
    <main-layout>
        <h2 slot="header">用户管理</h2>

        <section class="page-section">
            <div class="dsxui-form-inline">
                <div class="form-item">
                    <div class="form-item-label">UID</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" clearable v-model="params.uid"/>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">用户名</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" clearable v-model="params.nickname"/>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">手机号</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" clearable v-model="params.phone"/>
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item-label">邮箱</div>
                    <div class="form-item-input">
                        <el-input size="medium" class="w200" clearable v-model="params.email"/>
                    </div>
                </div>
                <div class="form-item">
                    <el-button size="medium" type="primary" @click="onSearch">查询</el-button>
                </div>
            </div>
        </section>

        <div class="page-section">
            <div class="tablenav tablenav-top">
                <el-tabs @tab-click="onClickTab" value="all">
                    <el-tab-pane label="全部" name="all"></el-tab-pane>
                    <el-tab-pane label="审核通过" name="1"></el-tab-pane>
                    <el-tab-pane label="等待审核" name="0"></el-tab-pane>
                    <el-tab-pane label="禁止登录" name="-1"></el-tab-pane>
                </el-tabs>
            </div>
            <el-table :data="dataList" v-loading="loading" @selection-change="onSelectionChange">
                <el-table-column width="45" type="selection"/>
                <el-table-column prop="uid" width="80" label="UID"/>
                <el-table-column label="头像" width="70">
                    <template slot-scope="scope">
                        <el-image :src="scope.row.avatar" class="img-40" fit="cover"></el-image>
                    </template>
                </el-table-column>
                <el-table-column label="昵称">
                    <template slot-scope="scope">
                        <a>{{ scope.row.nickname }}</a>
                    </template>
                </el-table-column>
                <el-table-column prop="phone" label="手机号"/>
                <el-table-column prop="group.name" width="120" label="分组"/>
                <el-table-column prop="credits" width="120" label="积分"/>
                <el-table-column prop="created_at" width="170" label="注册时间"/>
                <el-table-column width="100px" label="选项" align="right">
                    <template slot-scope="scope">
                        <router-link :to="'/user/edit/'+scope.row.uid" target="_blank">编辑</router-link>
                    </template>
                </el-table-column>
            </el-table>
            <div class="tablenav tablenav-bottom">
                <div class="table-actions">
                    <el-button size="small" type="primary" :disabled="selectionIds.length===0" @click="onDelete">
                        批量删除
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate({state:1})">
                        审核通过
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate({freeze:1})">
                        禁止登录
                    </el-button>
                    <el-button size="small" :disabled="selectionIds.length===0" @click="onBatchUpdate({freeze:0})">
                        允许登录
                    </el-button>
                </div>
                <el-pagination
                        background
                        layout="prev, pager, next, total"
                        :total="total"
                        :page-size="pageSize"
                        :current-page="page"
                        @current-change="onPageChange"
                >
                </el-pagination>
            </div>
        </div>
    </main-layout>
</template>

<script>
import PaginationMixin from "../mixins/PaginationMixin";
import UserService from "../utils/UserService";

export default {
    name: "UserList",
    mixins: [PaginationMixin],
    data() {
        return {
            params: {
                uid: '',
                nickname: '',
                status: '',
                email: '',
                phone: ''
            },
            amount: 10000,
            showDialog: false,
            user: {},
            listApi: '/users'
        }
    },
    methods: {
        onDelete() {
            let ids = this.selectionIds.map((d) => d.uid);
            this.$confirm('此操作将永久删除所选用户, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                UserService.deleteUser(ids).then(() => {
                    this.fetchList();
                });
            });
        },
        onClickTab(tab) {
            this.params.status = tab.name;
            this.onSearch();
        },
        onBatchUpdate(data) {
            let ids = this.selectionIds.map((d) => d.uid);
            UserService.batchUpdate(ids, data).then(() => {
                this.fetchList();
            });
        },
    },
    mounted() {
        this.fetchList();
    },
}
</script>

<style scoped>

</style>
