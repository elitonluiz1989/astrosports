import usersApi  from '../requests/users';

export const users = {
    state: {
        authUser: {},
        user: {},
        status: {
            auth: 0,
            users: 0
        }
    },

    actions: {
        loadAuthUser({ commit }, id) {
            commit('setUsersStatus', 'auth', 1);

            usersApi.getAuthUser()
                .then(response => {
                    commit('setAuthUser', response.data);
                    commit('setUsersStatus', 'auth', 2);
                })
                .catch(err => {
                    commit('setAuthUser', {});
                    commit('setUsersStatus', 'auth', 3);
                });
        },

        loadUser({commit}, id) {
            commit('setUsersStatus', 'users', 1);

            usersApi.loadUsers(id)
                .then(response => {
                    commit('setUser', response.data);
                    commit('setUsersStatus', 'users', 2);
                })
                .catch(err => {
                    commit('setUser', {});
                    commit('setUsersStatus', 'users', 3);
                });
        },

        loadUsers({commit}) {
            commit('setUsersStatus', 'users', 1);

            usersApi.getUsers()
                .then(response => {
                    commit('setUsers', response.data);
                    commit('setUsersStatus', 'users', 2);
                })
                .catch(err => {
                    commit('setUsers', {});
                    commit('setUsersStatus', 'users', 3);
                });
        }
    },

    mutations: {
        setAuthUser(state, user) {
            state.authUser = user;
        },

        setUser(state, user) {
            state.user = user;
        },

        setUsers(state, users) {
            state.users = users;
        },

        setUsersStatus(state, type, status) {
            state.status[type] = status;
        }
    },

    getters: {
        getAuthUser(state) {
            console.log(state.authUser.id)
            return state.authUser;
        },

        getUser(state) {
            return state.user;
        },

        getUsers(state) {
            return state.users;
        },

        getUsersStatus(state) {
            return state.status;
        }
    }
};