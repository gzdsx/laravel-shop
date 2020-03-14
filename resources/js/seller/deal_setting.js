const app = new Vue({
    el: '#app',
    data: {
        shop: {},
        reduce_type: 1,
        showModal: false
    },
    mounted() {
        $.ajax({
            url: '/seller/deal/getshop',
            success: function (response) {
                app.shop = response.shop;
                app.reduce_type = 2;
            }
        });
    },
    methods: {
        setReduceType() {
            app.showModal = false;
            const reduce_type = this.reduce_type;
            $.ajax({
                url: '/seller/deal/update',
                data: {reduce_type},
                type: 'POST',
                success: (response) => {
                    app.shop = response.shop;
                }
            });
        },
        showReduceType: () => {
            app.showModal = true;
        },
        hideModal:()=>{
            app.showModal = false;
        }
    }
});
