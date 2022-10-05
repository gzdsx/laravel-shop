export default {
    data() {
        return {
            page: 1,
            total: 0,
            pageSize: 15,
            dataList: [],
            params: {},
            listApi: '',
            selectionIds: [],
            loading: false,
        }
    },
    methods: {
        fetchList() {
            if (this.loading) {
                return;
            } else {
                this.loading = true;
            }

            let {page, pageSize, params, listApi} = this;
            let offset = (page - 1) * pageSize;
            let count = pageSize;
            this.$get(listApi, {...params, offset, count}).then(response => {
                let {total, items} = response.result;
                this.total = total;
                this.dataList = items;
                this.loading = false;
                this.onFinish(response);
            });
        },
        onSelectionChange(val) {
            this.selectionIds = val;
        },
        onPageChange(page) {
            this.page = page;
            this.fetchList();
        },
        onSearch() {
            this.page = 1;
            this.fetchList();
        },
        onFinish() {

        }
    }
}
