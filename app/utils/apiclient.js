import {DeviceEventEmitter} from 'react-native';
import axios from 'axios';
import AsyncStorage from "@react-native-async-storage/async-storage";
import {AccessToken, BaseApi, UserDidLogoutNotification} from "../base/constants";

const request = async (path, data = {}, method = 'GET', headers = {}) => {
    const url = BaseApi + path;
    const token = await AsyncStorage.getItem(AccessToken);
    return new Promise((resolve, reject) => {
        let requestConfig = {
            url,
            method,
            headers: {
                'Authorization': 'Bearer ' + token,
                ...headers
            },
        };
        if (method.toLocaleUpperCase() === 'POST') {
            requestConfig.data = data;
        } else {
            requestConfig.params = data;
        }
        axios(requestConfig).then(response => {
            if (response.data.errcode || response.data.errmsg) {
                if (__DEV__) {
                    console.log(url);
                    console.log(data);
                    console.log(response);
                }
                if (response.data.errcode === 401) {
                    DeviceEventEmitter.emit(UserDidLogoutNotification);
                }
                reject(response);
            } else {
                resolve(response);
            }
        }).catch(error => {
            if (__DEV__) {
                console.log(url);
                console.log(data);
                console.log(error);
            }
            if (error.response.status === 401) {
                DeviceEventEmitter.emit(UserDidLogoutNotification);
            }
            reject(error);
        });
    });
};

const get = (path, data, headers = {}) => {
    return request(path, data, 'GET', headers);
};

const post = (path, data, headers = {}) => {
    return request(path, data, 'POST', headers);
};

const upload = (path, file) => {
    const formData = new FormData();
    formData.append('file', {
        type: 'application/octet-stream',
        ...file
    });
    return post(path, formData);
};

export default {
    request,
    get,
    post,
    upload,
};
