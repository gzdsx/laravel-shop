export default {
    data() {
        return {
            offset: 0,
            pageSize: 15,
            loading: true,
            refreshing: false,
            loadMore: false,
            finished: false,
            loadingMore: false,
            listApi: '',
            params: {},
            dataList: []
        }
    },
    methods: {
        fetchList() {
            let {listApi, offset, pageSize, params} = this;
            this.$get(listApi, {...params, offset, count: pageSize}).then(response => {
                let {items} = response.result;
                if (this.loadMore) {
                    this.dataList = this.dataList.concat(items);
                } else {
                    this.dataList = items;
                }

                this.loading = false;
                this.refreshing = false;
                this.loadMore = false;
                this.finished = items.length !== this.pageSize;
                this.onLoaded(response);
                if (this.finished) {
                    this.onFinish();
                }
            }).catch(reason => {
                console.log(reason);
            });
        },
        onLoaded(response) {
        },
        onRefresh() {
            setTimeout(this.onSearch, 1000);
        },
        onLoadMore() {
            if (this.loading || this.refreshing || this.loadMore || this.finished) {
                return;
            }
            this.offset += this.pageSize;
            this.loadMore = true;
            this.fetchList();
        },
        onSearch() {
            if (this.loading || this.loadMore) {
                return;
            }

            this.offset = 0;
            this.fetchList();
        },
        onFinish() {

        }
    },
}
