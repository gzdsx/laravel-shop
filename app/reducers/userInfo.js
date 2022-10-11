import * as types from '../actions/types';

const initialState = {};

function userInfo(state = initialState, action) {
    if (action.type === types.USER_DID_CHANGE) {
        const {userInfo} = action;
        return Object.assign({}, state, userInfo);
    }
    return state;
}

module.exports = userInfo;
