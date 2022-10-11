import {DeviceEventEmitter} from 'react-native';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import {
    AccessToken,
    BaseApi,
    OAuthApi,
    OAuthClientID,
    OAuthClientSecret,
    UserDidSignoutedNotification,
} from '../base/constants';

const request = async (path, data = {}, method = 'GET', headers = {}) => {
    const url = BaseApi + path;
    const token = await AsyncStorage.getItem(AccessToken);
    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
    }
    return new Promise((resolve, reject) => {
        let requestConfig = {
            url,
            method,
            headers,
        };
        if (method.toLocaleUpperCase() === 'GET') {
            requestConfig.params = data;
        } else {
            requestConfig.data = data;
        }
        axios(requestConfig).then(response => {
            if (response.data.errCode || response.data.errMsg) {
                if (__DEV__) {
                    console.log(url);
                    console.log(data);
                    console.log(response.data);
                }
                if (response.data.errCode === 401) {
                    DeviceEventEmitter.emit(UserDidSignoutedNotification);
                }
                reject(response.data);
            } else {
                resolve(response.data);
            }
        }).catch(error => {
            if (__DEV__) {
                console.log(url);
                console.log(data);
                console.log(error);
            }
            if (error.response.status === 401) {
                DeviceEventEmitter.emit(UserDidSignoutedNotification);
            }
            reject(error.response.data);
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
    if (!file.type) {
        file.type = 'application/octet-stream';
    }

    const formData = new FormData();
    formData.append('file', file);
    return request(path, formData, 'POST', {
        'Content-Type': 'multipart/form-data'
    });
};

const login = (username, password, data = {}) => {
    return new Promise((resolve, reject) => {
        axios.post(OAuthApi + '/token', {
            'grant_type': 'password',
            'client_id': OAuthClientID,
            'client_secret': OAuthClientSecret,
            'username': username,
            'password': password,
            'scope': '*',
            ...data,
        }).then(response => {
            const {access_token} = response.data;
            AsyncStorage.setItem(AccessToken, access_token, () => {
                resolve(response.data);
            });
        }).catch(reason => {
            reject(reason.response.data);
        });
    });
};

export default {
    request,
    get,
    post,
    upload,
    login
};
