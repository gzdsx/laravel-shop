import {put, call, fork, take, takeEvery} from 'redux-saga/effects';
import * as types from '../actions/types';
import {ApiClient} from "../utils";

export function* fetchUserInfo() {
    try {
        let response = yield ApiClient.get('/user/info.getInfo');
        yield put({type: types.USER_DID_CHANGE, userInfo: response.result});
    } catch (e) {
        yield put({type: types.USER_DID_SIGNOUT});
    }
}

export function* watchFetchUserInfo() {
    while (true) {
        yield take(types.USER_DID_SIGNIN);
        yield fork(fetchUserInfo);
    }
}
