<template>
    <div class="container">
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <product-column :products="items"></product-column>
        </van-pull-refresh>
        <tab-bar :active-index="1"/>
    </div>
</template>

<script>
    import ProductColumn from "../common/ProductColumn";
    import {bindLoadMore} from "../lib/loadmore";
    import TabBar from "../common/TabBar";
    import ListMixin from "../lib/ListMixin";

    export default {
        name: "ProductIndex",
        components: {
            TabBar,
            ProductColumn
        },
        mixins: [ListMixin],
        data() {
            return {
                items: []
            }
        },
        mounted() {
            this.fetchList();
            bindLoadMore(this.onLoadMore);
        },
        methods: {
            fetchList() {
                this.$get('/ecom/product/list', {
                    ...this.searchFields,
                    offset: this.offset,
                    count: this.pageSize,
                    sort: 'time-desc'
                }).then(response => {
                    let {items} = response.result;
                    if (this.loadMore) {
                        this.items = this.items.concat(items);
                    } else {
                        this.items = items;
                    }

                    this.endLoad(items);
                });
            },
            onSearch() {
                this.items = [];
                this.offset = 0;
                this.fetchList();
            }
        }
    }
</script>

<style scoped>

</style>
