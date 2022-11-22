import {all, fork, take} from 'redux-saga/effects';
import {fetchUserInfo, watchUserInfo, watchOauth} from "./user";
import {checkAuthentication} from "./oauth";

export function* sagas() {
    yield fork(checkAuthentication);
    yield all([
        watchUserInfo(),
        watchOauth(),
    ]);
}
