<template>
    <div class="container">
        <van-address-list
                v-model="chosenAddressId"
                :list="list"
                @add="onAdd"
                @edit="onEdit"
                @select="onSelect"
        />
        <van-popup v-model="showPopup" closeable get-container="body" position="bottom">
            <van-address-edit
                    :area-list="areaList"
                    show-postal
                    :show-delete="showDelete"
                    show-set-default
                    show-search-result
                    :search-result="searchResult"
                    :area-columns-placeholder="['请选择', '请选择', '请选择']"
                    :address-info="addressInfo"
                    @save="onSave"
                    @delete="onDelete"
            />
        </van-popup>
    </div>
</template>

<script>
    import areaList from '../areas';

    export default {
        name: 'App',
        data() {
            return {
                areaList,
                searchResult: [],
                showPopup: false,
                list: [],
                chosenAddressId: 0,
                addressInfo: {},
                showDelete:false
            };
        },
        methods: {
            onSave: function (content) {
                //console.log(content);
                var _this = this;
                const address_id = this.addressInfo.id ? this.addressInfo.id : 0;
                const {name, tel, province, city, county, isDefault, addressDetail, areaCode} = content;
                const address = {
                    name,
                    tel,
                    province,
                    city,
                    district: county,
                    street: addressDetail,
                    postalcode: areaCode,
                    isdefault: isDefault
                };
                this.$axios.post('/h5/address/save', {address_id, address}).then(response => {
                    _this.$toast.success({
                        message: '收货地址已保存',
                        onClose: function () {
                            _this.showPopup = false;
                            _this.addressInfo = {};
                            _this.fetchList();
                        }
                    });
                });
            },
            onDelete: function (addr) {
                this.showPopup = false;
                this.$axios.post('/h5/address/delete', {address_id: this.addressInfo.id}).then(response => {
                    this.fetchList();
                });
            },
            onSelect: function (addr) {
                this.$emit('select', addr);
            },
            onEdit: function (addr) {
                this.$axios.get('/h5/address/get?address_id=' + addr.id).then(response => {
                    const {address_id, name, tel, province, city, district, street, postalcode, isdefault} = response.data.address;
                    this.addressInfo = {
                        id: address_id,
                        name,
                        tel,
                        province,
                        city,
                        county: district,
                        addressDetail: street,
                        postalCode: postalcode,
                        isDefault: !!isdefault
                    };
                    //console.log(this.addressInfo);
                    this.showPopup = true;
                    this.showDelete = true;
                });
            },
            onAdd: function () {
                this.showPopup = true;
                this.showDelete = false;
            },
            fetchList: function () {
                this.$axios.get('/h5/address/batchget').then(response => {
                    //console.log(response.data);
                    let list = [];
                    response.data.items.map((d) => {
                        list.push({
                            id: d.address_id,
                            name: d.name,
                            tel: d.tel,
                            address: d.province + d.city + d.district + d.street,
                            isDefault: d.isdefault
                        });
                        if (d.isdefault) {
                            this.chosenAddressId = d.address_id;
                        }
                    });
                    this.list = list;
                });
            }
        },
        mounted() {
            this.fetchList();
        }
    };
</script>

<style scoped>

</style>
