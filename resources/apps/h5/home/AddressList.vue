<template>
    <loading-view v-if="loading"/>
    <div class="container" v-else>
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <div style="min-height: 60vh;">
                <div class="address-list" v-if="dataList.length">
                    <van-swipe-cell v-for="(addr,index) in dataList" :key="index">
                        <van-cell
                                :title="addr.name+' '+addr.phone"
                                :label="addr.formatted_address"
                                is-link
                                center
                                size="large"
                                :border="true"
                                @click="onChooseAddress(addr)"
                        >
                            <div slot="right-icon" @click.stop="onShowEdit(addr)">
                                <span class="iconfont icon-edit-square"></span>
                            </div>
                        </van-cell>
                        <div class="van-swipe-cell-delete-slot" slot="right" @click="onDelete(index)">
                            <span>删除</span>
                        </div>
                    </van-swipe-cell>
                </div>
                <van-empty description="暂无记录" v-else/>
            </div>
        </van-pull-refresh>
        <fixed-bottom>
            <van-button type="info" block round @click="showPopup=true">+添加地址</van-button>
        </fixed-bottom>
        <van-popup v-model="showPopup" round :style="{'width':'85%'}">
            <div class="blank"></div>
            <van-field
                    v-model="address.name"
                    label="姓名"
                    placeholder="请填写收货人姓名"
                    size="large"
                    label-width="80"
            />
            <van-field
                    v-model="address.phone"
                    label="电话"
                    placeholder="请填写电话"
                    size="large"
                    label-width="80"
            />
            <van-field
                    v-model="region"
                    label="地区"
                    placeholder="请选择地区"
                    size="large"
                    label-width="80"
                    is-link
                    readonly
                    @click="showPicker=true"
            />
            <van-field
                    v-model="address.street"
                    label="详细地址"
                    placeholder="请填写详细地址"
                    size="large"
                    label-width="80"
            />
            <van-cell title="默认地址" size="large" center>
                <van-switch v-model="isdefault"/>
            </van-cell>
            <div class="h40"></div>
            <van-cell :border="false">
                <van-button type="info" block round @click="onSubmit">提交</van-button>
            </van-cell>
        </van-popup>
        <map-picker v-model="showPicker" @confirm="onChooseLocation"/>
    </div>
</template>

<script>
    import areas from "../lib/areas";
    import MapView from "../common/MapView";
    import MapPicker from "../common/MapPicker";

    export default {
        name: "AddressList",
        components: {MapPicker, MapView},
        data() {
            return {
                dataList: [],
                loading: true,
                refreshing: false,
                showPopup: false,
                address: {},
                areas,
                region: '省/市/区县',
                isdefault: false,
                showPicker: false
            }
        },
        methods: {
            fetchList() {
                this.$get('/user/address.list').then(response => {
                    this.dataList = response.result.items;
                    this.loading = false;
                    this.refreshing = false;
                });
            },
            onRefresh() {
                setTimeout(this.fetchList, 1000);
            },
            onChooseLocation(position) {
                let {province, city, district, street} = position;
                this.region = province + '/' + city + '/' + district;
                this.address = {
                    ...this.address,
                    ...position
                };
            },
            onDelete(index) {
                let {id} = this.dataList[index];
                this.$post('/user/address.delete', {id}).then(response => {
                    this.dataList.splice(index, 1);
                });
            },
            onShowEdit(d) {
                this.address = d;
                this.region = d.province + '/' + d.city + '/' + d.district;
                this.isdefault = d.isdefault === 1;
                this.showPopup = true;
            },
            onChooseAddress(addr) {
                this.$emit('select', addr);
            },
            onSubmit() {
                let {address} = this;
                if (!address.name) {
                    this.$toast('请填写姓名');
                    return false;
                }

                if (!address.phone) {
                    this.$toast('请填写姓名');
                    return false;
                }

                if (!address.province) {
                    this.$toast('请选择地区');
                    return false;
                }

                let {id} = this.address;
                address.isdefault = this.isdefault;
                this.$post('/user/address.save', {id, address}).then(response => {
                    this.showPopup = false;
                    this.fetchList();
                    this.reset();
                }).catch(r => {
                    this.$toast.fail(r.errMsg);
                });
            },
            reset() {
                this.address = {
                    name: '',
                    phone: ''
                }
                this.isdefault = false;
            }
        },
        mounted() {
            this.reset();
            this.fetchList();
        }
    }
</script>

<style scoped>

</style>
