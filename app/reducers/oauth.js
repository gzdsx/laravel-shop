import * as types from '../actions/types';

const initialState = {
    isAuthenticated: false
};

function oauth(state = initialState, action) {
    if (action.type === types.USER_DID_SIGNIN) {
        return Object.assign({}, state, {
            isAuthenticated: true
        });
    }

    if (action.type === types.USER_DID_SIGNOUT) {
        return Object.assign({}, state, {
            isAuthenticated: false
        });
    }
    return state;
}

module.exports = oauth;
