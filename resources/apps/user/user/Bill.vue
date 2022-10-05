<template>
    <div class="content-block">
        <div class="console-title">
            <div class="float-right">
                <strong class="font-18">账户余额: <span>{{account.balance}}</span></strong>
            </div>
            <h2>我的钱包->交易明细</h2>
        </div>

        <section class="section">
            <div class="transaction-filter">
                <div class="transaction-filter-row">
                    <div class="transaction-filter-row-label">交易时间:</div>
                    <div class="transaction-filter-row-content">
                        <a v-for="(type,index) in date_ranges"
                           :key="index"
                           :class="{'cur':searchFields.date_range===index}"
                           @click="handleFilter({date_range:index})"
                        >{{type}}</a>
                    </div>
                </div>
                <div class="transaction-filter-row">
                    <div class="transaction-filter-row-label">交易类型:</div>
                    <div class="transaction-filter-row-content">
                        <a v-for="(type,index) in transaction_types"
                           :key="index"
                           :class="{'cur':searchFields.transaction_type===index}"
                           @click="handleFilter({transaction_type:index})"
                        >{{type}}</a>
                    </div>
                </div>
                <div class="transaction-filter-row">
                    <div class="transaction-filter-row-label">支付方式:</div>
                    <div class="transaction-filter-row-content">
                        <a v-for="(type,index) in pay_types"
                           :key="index"
                           :class="{'cur':searchFields.pay_type===index}"
                           @click="handleFilter({pay_type:index})"
                        >{{type}}</a>
                    </div>
                </div>
                <div class="transaction-filter-row">
                    <div class="transaction-filter-row-label">关键字:</div>
                    <div class="transaction-filter-row-content">
                        <el-input size="medium" class="w400" placeholder="交易名称，流水号" v-model="searchFields.q"></el-input>
                        <el-button size="medium" type="primary" style="margin-left: 10px;" @click="handleSearch">搜索
                        </el-button>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <table class="transaction-table">
                <thead>
                <tr>
                    <th class="first">创建时间</th>
                    <th>名称 | 流水号</th>
                    <th class="amount">金额</th>
                    <th class="last">状态</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items" :key="index">
                    <td class="time">
                        <div class="date">{{formatDate(item.created_at)}}</div>
                        <p>{{formatTime(item.created_at)}}</p>
                    </td>
                    <td class="name">
                        <h3>{{item.subject}}</h3>
                        <p>流水:{{item.out_trade_no}}</p>
                    </td>
                    <td class="amount">
                        <span style="color: #0BB20C;" v-if="item.payee_uid===userinfo.uid">+{{item.amount}}</span>
                        <span style="color: #ff0000;" v-else>-{{item.amount}}</span>
                    </td>
                    <td class="align-right">{{item.pay_state_des}}</td>
                </tr>
                </tbody>
            </table>
            <div class="display-flex" style="margin-top: 5px;">
                <div class="flex"></div>
                <el-pagination
                        background
                        layout="prev, pager, next, total"
                        :total="total"
                        :page-size="pageSize"
                        @current-change="handlePageChange"
                >
                </el-pagination>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Bill",
        components: {},
        data() {
            return {
                account: {},
                searchFields: {
                    date_range: 'all',
                    pay_type: 'all',
                    transaction_type: 'all'
                },
                transaction_types: {
                    'all': '全部',
                    'shopping': '购物',
                    'charge': '缴费',
                    'other': '其他',
                },
                pay_types: {
                    'all': '全部',
                    'wechatpay': '微信支付',
                    'alipay': '支付宝',
                    'unipay': '银联支付',
                    'balance': '余额支付'
                },
                date_ranges: {
                    'all': '全部',
                    '3days': '近3天',
                    '7days': '近一周',
                    'oneMonth': '近一个月',
                    'threeMonth': '近三个月',
                    'oneYear': '近一年',
                },
                items: [],
                total: 0,
                offset: 0,
                pageSize: 15,
            }
        },
        computed: {
            userinfo(){
                return this.$store.state.auth.userinfo;
            }
        },
        mounted() {
            this.fetchList();
            this.$get('/account/get').then(response => {
                this.account = response.result.account;
            });
        },
        methods: {
            fetchList() {
                this.$get('/transaction/batchget', {
                    ...this.searchFields,
                    offset: this.offset
                }).then(response => {
                    this.items = response.result.items;
                    this.total = response.result.total;
                });
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;
                return year + '年' + month + '月' + day + '日';
            },
            formatTime(date) {
                var d = new Date(date),
                    h = '' + d.getHours(),
                    m = '' + d.getMinutes(),
                    s = '' + d.getSeconds();

                if (h.length < 2) h = '0' + h;
                if (m.length < 2) m = '0' + m;
                if (s.length < 2) s = '0' + s;
                return h + ':' + m + ':' + s;
            },
            handlePageChange(page) {
                this.offset = (page - 1) * this.pageSize;
                this.fetchList();
            },
            handleFilter(params) {
                this.searchFields = {
                    ...this.searchFields,
                    ...params
                };
                this.offset = 0;
                this.fetchList();
            },
            handleSearch() {
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
