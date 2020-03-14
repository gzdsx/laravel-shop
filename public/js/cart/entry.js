var app = new Vue({
    el: '#app',
    data: {
        shops: [],
        totalCount: 0,
        checkedAll: false,
    },
    computed: {
        totalFee: function () {
            var totalFee = 0;
            var totalCount = 0;
            this.shops.map(function (shop) {
                shop.items.map(function (item) {
                    if (item.checked) {
                        totalFee += item.price * item.quantity;
                        totalCount += item.quantity;
                    }
                });
            });
            this.totalCount = totalCount;
            return totalFee.toFixed(2);
        }
    },
    created: function () {
        var $this = this;
        shops.forEach(function (data) {
            data.shop.checked = false;
            data.items.forEach(function (item) {
                item.checked = false;
                $this.totalCount++;
            });
        });
        this.shops = shops;
    },
    methods: {
        decrease: function (item) {
            if (item.quantity > 1) {
                item.quantity--;
                this.updateQuantity(item.itemid, item.quantity);
            }
        },
        increase: function (item) {
            item.quantity++;
            this.updateQuantity(item.itemid, item.quantity);
        },
        updateQuantity: function (itemid, quantity) {
            $.ajax({
                type: 'POST',
                url: '/cart/update',
                data: {itemid: itemid, quantity: quantity}
            });
        },
        deleteItem: function (data, item) {
            DSXUI.showConfirm('确认要删除所选商品吗?', function () {
                $.ajax({
                    type: 'POST',
                    url: '/cart/delete',
                    data: {items: [item.itemid]},
                    success: function (response) {
                        data.items = data.items.filter(function (itm) {
                            if (itm.itemid !== item.itemid) return itm;
                        });
                    }
                });
            });
        },
        checkAll: function () {
            var checked = app.checkedAll;
            this.shops.forEach(function (gp) {
                gp.shop.checked = checked;
                gp.items.forEach(function (item) {
                    item.checked = checked;
                });
            });
        },
        checkGroup: function (gp) {
            gp.items.forEach(function (item) {
                item.checked = gp.shop.checked;
            });
            this.dataChanged();
        },
        checkItem: function (item) {
            this.dataChanged();
        },
        dataChanged: function () {
            var totalCount = 0;
            var selectedCount = 0;
            this.shops.map(function (group) {
                var groupCount = 0;
                group.items.map(function (item) {
                    if (item.checked) {
                        groupCount++;
                        selectedCount++;
                    }
                    totalCount++;
                });
                group.shop.checked = groupCount === group.items.length;
            });

            this.checkedAll = totalCount === selectedCount;
        },
        settlement: function () {
            if (this.totalCount > 0) {
                $("#FrmCart").submit();
            }
        }
    }
});
