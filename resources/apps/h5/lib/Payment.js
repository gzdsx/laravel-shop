export default {
    requestPay(order_id) {
        return new Promise((resolve, reject) => {
            axios.post('/wechat/pay/unify', {
                order_id,
                appid: 1,
                openid: window.openid
            }).then(response => {
                //console.log(response.data);
                if (response.data.errcode) {
                    reject(response);
                } else {
                    let config = response.data.config;
                    if (!config.timestamp) {
                        config.timestamp = config.timeStamp;
                    }
                    config.success = function (res) {
                        resolve(res);
                    }

                    config.cancel = function (res) {
                        //reject(res);
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