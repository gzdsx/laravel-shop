import Payment from './Payment';

export default {
    pay(order_id) {
        return Payment.requestPay(order_id);
    },
    cancel(order_id, reason) {
        return new Promise((resolve, reject) => {
            axios.post('/api/bought/close', {order_id, reason}).then(response => {
                if (response.data.errcode) {
                    reject(response.data);
                } else {
                    resolve(response.data);
                }
            }).catch(reason => {
                reject(reason);
            });
        });
    },
    notice(order_id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/bought/notice', {order_id}).then(response => {
                if (response.data.errcode) {
                    reject(response.data);
                } else {
                    resolve(response.data);
                }
            }).catch(reason => {
                reject(reason);
            });
        });
    },
    confirm(order_id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/bought/confirm', {order_id}).then(response => {
                if (response.data.errcode) {
                    reject(response.data);
                } else {
                    resolve(response.data);
                }
            }).catch(reason => {
                reject(reason);
            });
        });
    },
    delete(order_id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/bought/delete', {order_id}).then(response => {
                if (response.data.errcode) {
                    reject(response.data);
                } else {
                    resolve(response.data);
                }
            }).catch(reason => {
                reject(reason);
            });
        });
    }
};
