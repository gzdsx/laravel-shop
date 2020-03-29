<template>
    <div class="container">
        <van-address-edit
                :area-list="areaList"
                show-postal
                show-delete
                show-set-default
                show-search-result
                :search-result="searchResult"
                @save="onSave"
                @delete="onDelete"
                @change-detail="onChangeDetail"
        />
    </div>
</template>

<script>
    import {AddressList, AddressEdit, Popup} from 'vant';
    import areaList from '../../areas';

    Vue.use(AddressList);
    Vue.use(AddressEdit);
    Vue.use(Popup);

    export default {
        name: 'App',
        data() {
            return {
                areaList,
                searchResult: [],
                showPopup: false
            };
        },
        methods: {},
    };
</script>

<style scoped>

</style>
