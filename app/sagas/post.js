import {put, call, fork, take} from 'redux-saga/effects';
import * as types from '../actions/types';
import ApiClient from "../utils/ApiClient";

export function* requestPostList(catid, offset = 0, count = 20) {
    try {
        const response = yield call(ApiClient.get, '/post/batchget', {
            catid,
            offset,
            count,
        });
        yield put(receivePostList(response.data.items, catid));
    }catch (e) {
        yield put(receivePostList([], catid));
        console.log('fetch post list error===');
        console.log(e);
    }
}

export function* watchRequestPostList() {
    while (true) {
        const {catid, offset, count} = yield take(types.FETCH_POST_LIST);
        yield fork(requestPostList, catid, offset, count);
    }
}
