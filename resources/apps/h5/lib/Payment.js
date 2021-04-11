export default {
    requestPay(order_id) {
        return new Promise((resolve, reject) => {
            axios.post('/api/wechat/pay/unify', {
                order_id,
                appid: 1,
                openid: window.openid
            }).then(response => {
                //console.log(response.result);
                if (response.result.errcode) {
                    reject(response);
                } else {
                    let config = response.result.config;
                    if (!config.timestamp) {
                        config.timestamp = config.timeStamp;
                    }
                    config.success = function (res) {
                        resolve(res);
                    }

                    config.cancel = function (res) {
                        reject({errMsg: '付款已取消'});
                    }

                    config.fail = function (res) {
                        reject(res);
                    }

                    wx.chooseWXPay(config);
                }
            }).catch(reason => {
                reject(reason);
            });
        });
    }
};
