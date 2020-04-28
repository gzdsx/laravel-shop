<template>
    <div class="content-block">
        <div class="console-title">
            <div class="float-right">
                <el-button type="primary" size="small" @click="handleShowAdd">添加收货地址</el-button>
            </div>
            <h2>收货地址管理</h2>
        </div>
        <section class="section">
            <table class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="120">联系人</th>
                    <th width="120">电话</th>
                    <th>地址</th>
                    <th width="80">邮编</th>
                    <th width="90">选项</th>
                    <th width="80"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in itemList" :key="index">
                    <td height="50"><b>{{item.name}}</b></td>
                    <td>{{item.tel}}</td>
                    <td>{{item.full_address}}</td>
                    <td>{{item.postalcode}}</td>
                    <td>
                        <a @click="handleShowEdit(item)">修改</a>
                        <a @click="handleDelete(item.address_id)">删除</a>
                    </td>
                    <td>
                        <div v-if="item.isdefault" style="color: #f00;">默认地址</div>
                        <a v-else @click="handleSetDefault(item.address_id)">设为默认</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>

        <address-form :address="address" v-model="showDialog" @saved="handleSave"></address-form>
    </div>
</template>

<script>
    import AddressForm from "./AddressForm";
    export default {
        name: "Address",
        components:{
            AddressForm
        },
        data: function () {
            return {
                itemList: [],
                address: {},
                showDialog: false,
            }
        },
        mounted() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                this.$get('/user/address/batchget').then(response => {
                    this.itemList = response.data.items;
                });
            },
            handleShowAdd() {
                this.resetData();
                this.showDialog = true;
            },
            handleShowEdit(address) {
                this.address = address;
                this.showDialog = true;
            },
            handleSave(address) {
                this.resetData();
                this.fetchList();
            },
            handleSetDefault(address_id) {
                this.$post('/user/address/setdefault', {address_id}).then(response => {
                    this.fetchList();
                });
            },
            handleDelete(address_id) {
                this.$confirm('此操作将永久删除所选信息, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.post('/user/address/delete', {address_id}).then(response => {
                        this.fetchList();
                    });
                });
            },
            resetData() {
                this.address = {};
            }
        }
    }
</script>

<style scoped>

</style>
