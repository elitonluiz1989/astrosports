import usersApi  from '../../api/users';
import {messageErrorHandler} from "../../messageErrorHandler";

export const users = {
    state: {
        user: {},
        users: [],
        messageErrors: null,
        usersRequestStatus: 0,
        pagination: {
            total: 0,
            page: 0,
            next: 0,
            prev: 0,
            limit: 0
        }
    },

    actions: {
        loadUser({commit}, id) {
            commit('setUsersRequestStatus', 1);

            usersApi.loadUsers(id)
                .then(response => {
                    commit('setUser', response.data);
                    commit('setUsersRequestStatus', 2);
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
                    commit('setUsers', response.data);
                    commit('setUsersRequestStatus', 2);
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
            state.pagination.total = users.total;
            state.pagination.page = users.current_page;
            state.pagination.next = users.to;
            state.pagination.prev = users.from;
            state.pagination.limit = users.per_page;

            state.users = users.data;
        },

        setUsersRequestStatus(state, status) {
            state.usersRequestStatus = status;
        },

        setUsersMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
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
        },

        getUsersPagination(state) {
            return state.pagination;
        }
    }
};