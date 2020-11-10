import * as types from '../actions/types';

const initialState = {
    isLoggedIn:false,
    userinfo:{}
};

function auth(state = initialState, action) {
    if (action.type === types.USER_DID_LOGGEDIN){
        return Object.assign({}, state, {
            isLoggedIn:true,
            userinfo:action.userinfo
        });
    }

    if (action.type === types.USER_DID_LOGOUT) {
        return Object.assign({}, state, {
            isLoggedIn:false,
            userinfo:{}
        });
    }
    return state;
}

module.exports = auth;
