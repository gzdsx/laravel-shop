import * as types from "./types";

export function userDidSignIn() {
    return {
        type: types.USER_DID_SIGNIN
    }
}

export function userDidSignOut() {
    return {
        type: types.USER_DID_SIGNOUT
    }
}
