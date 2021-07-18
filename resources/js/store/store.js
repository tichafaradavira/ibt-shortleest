import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: {},
        token: ""

    },
    mutations: {
        updateUser(state, user) {
            state.user = user
        },
        updateToken(state, token) {
            state.token = token
        },
        resetState(state) {
            state.user = null;
            state.token = "";
        },
    },
    actions: {},
    getters: {
        getUser: state => {
            return state.user
        },

        getToken: state => {
            return state.token
        },


    },
});
