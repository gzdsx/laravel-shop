<template>
    <div class="container">
        <van-address-list
                v-model="chosenAddressId"
                :list="itemList"
                @add="handleAdd"
                @edit="handleEdit"
                @select="handleSelect"
        />
        <van-popup v-model="showPopup" closeable get-container="body" position="bottom">
            <van-address-edit
                    :area-list="areas"
                    show-postal
                    :show-delete="showDelete"
                    show-set-default
                    show-search-result
                    :search-result="searchResult"
                    :area-columns-placeholder="['请选择', '请选择', '请选择']"
                    :address-info="addressInfo"
                    @save="handleSave"
                    @delete="handleDelete"
            />
        </van-popup>
    </div>
</template>

<script>
    import areas from '../../lib/areas';

    export default {
        name: 'AddressView',
        data() {
            return {
                areas,
                itemList: [],
                searchResult: [],
                showPopup: false,
                chosenAddressId: 0,
                addressInfo: {},
                showDelete:false
            };
        },
        methods: {
            fetchList: function () {
                this.$get('/address/batchget').then(response => {
                    //console.log(response.data);
                    this.itemList = response.data.items.map((d) => {
                        if (d.isdefault) {
                            this.chosenAddressId = d.address_id;
                        }
                        return {
                            id: d.address_id,
                            name: d.name,
                            tel: d.tel,
                            address: d.full_address,
                            isDefault: d.isdefault,
                            original:d
                        }
                    });
                });
            },
            handleSave: function (content) {
                //console.log(content);
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
                this.showPopup = false;
                this.$post('/address/update', {address_id, address}).then(response => {
                    this.$toast.success({
                        message: '收货地址已保存',
                        onClose: () => {
                            this.addressInfo = {};
                            this.fetchList();
                        }
                    });
                });
            },
            handleDelete: function (addr) {
                this.showPopup = false;
                this.$post('/address/delete', {address_id: this.addressInfo.id}).then(response => {
                    this.fetchList();
                });
            },
            handleSelect: function (addr) {
                this.$emit('select', addr.original);
            },
            handleEdit: function (addr) {
                this.$get('/address/get?address_id=' + addr.id).then(response => {
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
            handleAdd: function () {
                this.showPopup = true;
                this.showDelete = false;
            },
        },
        mounted() {
            this.fetchList();
        }
    };
</script>

<style scoped>

</style>
