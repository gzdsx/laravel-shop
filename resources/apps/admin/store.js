import Vuex from 'vuex';

const store = new Vuex.Store({
    state: {
        isSignined: false,
        userInfo: {}
    },
    mutations: {
        signin(state, userInfo) {
            state.userInfo = userInfo;
            state.isSignined = true;
        },
        signout(state) {
            state.userInfo = {};
            state.isSignined = true;
        }
    }
});

module.exports = store;
