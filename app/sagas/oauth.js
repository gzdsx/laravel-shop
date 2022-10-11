import {put, call, fork, take} from 'redux-saga/effects';
import {userDidSignIn, userDidSignOut} from "../actions/oauth";
import AsyncStorage from "@react-native-async-storage/async-storage";
import {AccessToken} from "../base/constants";

export function* checkAuthentication() {
    try {
        let accessToken = yield AsyncStorage.getItem(AccessToken);
        if (accessToken) {
            yield put(userDidSignIn());
        }
    } catch (e) {
        yield put(userDidSignOut());
    }
}
