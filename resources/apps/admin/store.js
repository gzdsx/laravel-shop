import Vuex from 'vuex';

const store = new Vuex.Store({
    state: {
        auth: {
            isSignined: false,
            userinfo: {}
        }
    },
    mutations: {
        signin(state, userinfo) {
            state.auth = {
                userinfo,
                isSignined: true
            };
        },
        signout(state) {
            state.auth = {
                isSignined: false,
                userinfo: {}
            }
        }
    }
});

module.exports = store;
