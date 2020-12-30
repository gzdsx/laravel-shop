import {Alert} from "react-native";
import {ApiClient} from "./index";
import Alipay from "react-native-gzdsx-alipay";

export default {
    cancel(order_id, reason) {
        return new Promise((resolve, reject) => {
            ApiClient.post('/bought/close', {order_id, reason}).then(response => {
                resolve(response);
            }).catch(reason1 => {
                reject(reason1);
            });
        });
    },
    delete(order_id) {
        return new Promise((resolve, reject) => {
            Alert.alert('确定要删除此订单吗?', null, [
                {
                    text: '确定',
                    onPress: () => {
                        ApiClient.post('/bought/delete', {order_id}).then(response => {
                            resolve(response);
                        }).catch(reason => {
                            reject(reason);
                        });
                    }
                },
                {
                    text: '取消',
                    onPress: (val) => {
                        reject(val);
                    }
                }
            ])
        });
    },
    notice(order_id) {
        return new Promise((resolve, reject) => {
            ApiClient.post('/bought/notice', {order_id}).then(response => {
                resolve(response);
            }).catch(reason => {
                reject(reason);
            })
        });
    },
    confirm(order_id) {
        return new Promise((resolve, reject) => {
            Alert.alert('确认收货', '请确认是否已收到货品', [
                {
                    text: '确定',
                    onPress: () => {
                        ApiClient.post('/bought/confirm', {order_id}).then(response => {
                            resolve(response);
                        }).catch(reason => {
                            reject(reason);
                        })
                    }
                },
                {
                    text: '取消',
                    onPress: val => {
                        reject(val);
                    }
                }
            ]);
        });
    },
    pay(order_id, type = 1) {
        if (type === 1) {
            return new Promise((resolve, reject) => {
                ApiClient.get('/alipay/sign', {order_id}).then(response => {
                    Alipay.pay(response.data.payStr).then((data) => {
                        //console.log(data);
                        resolve(data);
                    }, (errCode, errMsg, reason) => {
                        console.log(errCode + ':' + errMsg);
                    });
                });
            });
        }
    }
}
