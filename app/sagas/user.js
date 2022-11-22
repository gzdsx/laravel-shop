import {put, call, fork, take, takeEvery} from 'redux-saga/effects';
import * as types from '../actions/types';
import {ApiClient} from "../utils";
import {receiveUserInfo} from "../actions/user";
import {userDidSignOut} from "../actions/oauth";

export function* fetchUserInfo() {
    try {
        let response = yield ApiClient.get('/user/info.getInfo');
        yield put(receiveUserInfo(response.result));
    } catch (e) {
        yield put(userDidSignOut());
    }
}

export function* watchUserInfo() {
    while (true) {
        yield take(types.USER_DID_CHANGE);
        yield fork(fetchUserInfo);
    }
}

export function* watchOauth() {
    yield take(types.USER_DID_SIGNIN);
    yield fork(fetchUserInfo);
}
