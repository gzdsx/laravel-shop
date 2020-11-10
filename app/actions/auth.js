import * as types from "./types";

export function userDidLoggedIn(userinfo) {
    return {
        userinfo,
        type:types.USER_DID_LOGGEDIN
    }
}

export function userDidLogout() {
    return {
        userinfo:{},
        type:types.USER_DID_LOGOUT
    }
}
