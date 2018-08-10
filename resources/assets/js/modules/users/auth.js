import usersApi  from '../../api/users';
import {messageErrorHandler} from "../../messageErrorHandler";

export const auth = {
    state: {
        user: {},
        messageErrors: null,
        authRequestStatus: 0,
    },

    actions: {
        loadAuthUser({ commit }) {
            commit('setAuthRequestStatus', 1);

            usersApi.getAuthUser()
                .then(response => {
                    commit('setAuthUser', response.data);
                    commit('setAuthRequestStatus', 2);
                })
                .catch(err => {
                    commit('setAuthUser', {});
                    commit('setAuthRequestStatus', 3);
                    commit('setMessageErrors', err);
                });
        },
    },

    mutations: {
        setAuthUser(state, user) {
            state.user = user;
        },

        setAuthRequestStatus(state, status) {
            state.authRequestStatus = status;
        },

        setMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
        }
    },

    getters: {
        getAuthUser(state) {
            return state.user;
        },

        getAuthUserGrant(state) {
            return state.user.role;
        },

        getAuthRequestStatus(state) {
            return state.usersRequestStatus;
        },

        getAuthMessageErrors(state) {
            return state.messageErrors;
        }
    }
};