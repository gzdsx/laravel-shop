import * as types from '../actions/types';

const initialState = {
    isSignined: false,
    userinfo: {}
};

function auth(state = initialState, action) {
    if (action.type === types.USER_DID_SIGNIN) {
        return Object.assign({}, state, {
            isSignined: true,
            userinfo: action.userinfo
        });
    }

    if (action.type === types.USER_DID_SIGNOUT) {
        return Object.assign({}, state, {
            isSignined: false,
            userinfo: {}
        });
    }
    return state;
}

module.exports = auth;
