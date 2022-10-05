import Vuex from 'vuex';
import {LOGIN, LOGOUT, USERDIDCHANGE} from "./types";

const store = new Vuex.Store({
    state: {
        isSignined: false,
        userInfo: {}
    },
    mutations: {
        [LOGIN](state, userInfo) {
            state.isSignined = true;
            state.userInfo = userInfo;
        },
        [LOGOUT](state) {
            state.isSignined = false;
            state.userInfo = {};
        },
        [USERDIDCHANGE](state, userInfo) {
            state.userInfo = userInfo;
        }
    }
});

module.exports = store;
