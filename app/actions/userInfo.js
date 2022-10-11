import * as types from "./types";

export function userDidChanged(userInfo) {
    return {
        userInfo,
        type: types.USER_DID_CHANGE
    }
}
