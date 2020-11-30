import * as types from "./types";

export function userDidSignIn(userinfo) {
    return {
        userinfo,
        type: types.USER_DID_SIGNIN
    }
}

export function userDidSignOut() {
    return {
        userinfo: {},
        type: types.USER_DID_SIGNOUT
    }
}
