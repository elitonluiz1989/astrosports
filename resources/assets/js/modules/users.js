import usersApi  from '../api/users';

export const users = {
    state: {
        user: {},
        users: [],
        messageErrors: null,
        usersRequestStatus: 0
    },

    actions: {
        loadUser({commit}, id) {
            commit('setUsersRequestStatus', 1);

            usersApi.loadUsers(id)
                .then(response => {
                    if (response.data.error) {
                        commit('setUser', {});
                        commit('setUsersRequestStatus', 3);
                        commit('setUsersMessageErrors', response.data.error);
                    } else {
                        commit('setUser', response.data);
                        commit('setUsersRequestStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setUser', {});
                    commit('setUsersRequestStatus', 3);
                    commit('setUsersMessageErrors', err);
                });
        },

        loadUsers({commit}) {
            commit('setUsersRequestStatus', 1);

            usersApi.getUsers()
                .then(response => {
                    if (response.data.error) {
                        commit('setUsers', []);
                        commit('setUsersRequestStatus', 3);
                        commit('setUsersMessageErrors', response.data.error);
                    } else {
                        commit('setUsers', response.data);
                        commit('setUsersRequestStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setUsers', []);
                    commit('setUsersRequestStatus', 3);
                    commit('setUsersMessageErrors', err);
                });
        }
    },

    mutations: {
        setUser(state, user) {
            state.user = user;
        },

        setUsers(state, users) {
            state.users = users;
        },

        setUsersRequestStatus(state, status) {
            state.usersRequestStatus = status;
        },

        setUsersMessageErrors(state, message) {
            state.messageErrors = message;
        }
    },

    getters: {
        getUser(state) {
            return state.user;
        },

        getUsers(state) {
            return state.users;
        },

        getUsersRequestStatus(state) {
            return state.usersRequestStatus;
        },

        getUsersMessageErrors(state) {
            return state.messageErrors;
        }
    }
};