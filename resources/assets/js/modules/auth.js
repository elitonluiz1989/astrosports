import usersApi  from '../api/users';

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
                    if (response.data.error) {
                        commit('setAuthUser', {});
                        commit('setAuthRequestStatus', 3);
                        commit('setMessageErrors', response.data.error);
                    } else {
                        commit('setAuthUser', response.data);
                        commit('setAuthRequestStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setAuthUser', {});
                    commit('setAuthRequestStatus', 3);
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
            state.messageErrors = message;
        }
    },

    getters: {
        getAuthUser(state) {
            return state.user;
        },

        getAuthRequestStatus(state) {
            return state.usersRequestStatus;
        },

        getAuthMessageErrors(state) {
            return state.messageErrors;
        }
    }
};