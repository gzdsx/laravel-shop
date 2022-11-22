import * as types from "./types";

export function userDidChanged() {
    return {
        type: types.USER_DID_CHANGE
    }
}

export function receiveUserInfo(userInfo) {
    return {
        userInfo,
        type: types.RECEIVE_USERINFO
    }
}
