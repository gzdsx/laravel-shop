<template>
    <div class="member">
        <div class="header">
            <div class="flex-row">
                <div class="avatar-container">
                    <img :src="userInfo.avatar" class="img-60 img-round" alt="">
                </div>
                <div class="flex-fill flex-column justify-content-center">
                    <div class="username">{{userInfo.username}}</div>
                    <div class="member" v-if="userInfo.member">
                        <img :src="userInfo.member.icon" class="member-icon" alt="">
                        <span>{{userInfo.member.title}}</span>
                    </div>
                    <div class="member" v-else>新手上路</div>
                </div>
            </div>
            <div class="data-container">
                <ul class="data-item">
                    <li>
                        <router-link to="/wallet">
                            <span>{{total}}</span>
                            <span class="iconfont icon-right"></span>
                        </router-link>
                    </li>
                    <li>
                        <span>总</span>
                        <span class="iconfont icon-present"></span>
                    </li>
                </ul>
                <div class="flex-fill"></div>
                <ul class="data-item">
                    <li>{{account.balance}}</li>
                    <li>
                        <span>可用</span>
                        <span class="iconfont icon-present"></span>
                    </li>
                </ul>
                <div class="flex-fill"></div>
                <ul class="data-item">
                    <li>
                        <router-link to="/wallet">
                            <span>{{account.freeze}}</span>
                            <span class="iconfont icon-right"></span>
                        </router-link>
                    </li>
                    <li>
                        <span>预留</span>
                        <span class="iconfont icon-present"></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cumulative-block">
            <div class="cumulative">
                <span>累计</span>
                <span class="iconfont icon-present"></span>
                <span class="amount">{{account.total_income}}</span>
            </div>
        </div>
        <div class="data-block">
            <div class="data-title">
                <span>我的下级</span>
            </div>

            <van-cell-group v-if="subusers.length>0">
                <van-cell
                        v-for="(user,index) in subusers"
                        :key="index"
                        :title="user.username"
                        :label="user.member ? user.member.title : ''"
                        center
                >
                    <div class="subuser-avatar" slot="icon">
                        <img :src="user.avatar" class="img-40 img-round" alt="">
                    </div>
                </van-cell>
            </van-cell-group>
            <div class="align-center" v-else>暂无下级</div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import ListMixin from "../../lib/ListMixin";
    import {bindLoadMore} from "../../lib/loadmore";

    export default {
        name: "MemberIndex",
        mixins: [ListMixin],
        data() {
            return {
                account: {},
                total: 0,
                subusers: []
            }
        },
        computed: {
            ...mapState(['userInfo'])
        },
        mounted() {
            this.setBackgroundColor('#EDEDED');
            this.$get('/user/account').then(response => {
                let {account} = response.result;
                this.account = account;
                this.total = (parseFloat(account.balance) + parseFloat(account.freeze)).toFixed(2);

            });
            this.fetchList();
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                this.$get('/user/subuser.list', {
                    offset: this.offset,
                    count: this.pageSize
                }).then(response => {
                    let {items} = response.result;
                    this.subusers = items;
                });
            }
        }
    }
</script>

<style scoped>
    .van-cell {
        line-height: 1.2;
        padding-left: 0;
    }
</style>
