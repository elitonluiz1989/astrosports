import schedulesApi  from '@js/api/users/userRoles';
import {messageErrorHandler} from "@js/messageErrorHandler";

export const userRoles = {
    state: {
        usersRole: {},
        userRoles: [],
        messageErrors: null,
        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0
        }
    },

    actions: {
        loadUserRole({commit}, id) {
            commit('setLoadUserRolesStatus', 1);

            schedulesApi.get(id)
                .then(response => {
                    commit('setUserRole', response.data);
                    commit('setLoadUserRolesStatus', 2);
                })
                .catch(err => {
                    commit('setUserRole', {});
                    commit('setLoadUserRolesStatus', 3);
                    commit('setUserRoleMessageErrors', err);
                });
        },

        loadUserRoles({commit}) {
            commit('setLoadUserRolesStatus', 1);

            schedulesApi.get()
                .then(response => {
                    commit('setUserRoles', response.data);
                    commit('setLoadUserRolesStatus', 2);
                })
                .catch(err => {
                    commit('setUserRoles', []);
                    commit('setLoadUserRolesStatus', 3);
                    commit('setUserRoleMessageErrors', err);
                });
        },

        addUserRole({commit, dispatch}, role) {
            commit('setAddUserRoleStatus', 1);

            schedulesApi.add(role)
                .then(response => {
                    commit('setAddUserRoleStatus', 2);
                    dispatch("loadUserRoles");
                })
                .catch(err => {
                    console.log(err, err.response)
                    commit('setAddUserRoleStatus', 3);
                    commit('setUserRoleMessageErrors', err);
                });
        },

        editUserRole({commit, dispatch}, role) {
            commit('setEditUserRoleStatus', 1);

            schedulesApi.edit(role)
                .then(response => {
                    commit('setEditUserRoleStatus', 2);
                    dispatch("loadUserRoles");
                    dispatch("loadUsers");
                })
                .catch(err => {
                    commit('setEditUserRoleStatus', 3);
                    commit('setUserRoleMessageErrors', err);
                });
        },

        deleteUserRole({commit, dispatch}, id) {
            commit('setDeleteUserRoleStatus', 1);

            schedulesApi.del(id)
                .then(response => {
                    commit('setDeleteUserRoleStatus', 2);
                    dispatch("loadUserRoles");
                    dispatch("loadUsers");
                })
                .catch(err => {
                    commit('setDeleteUserRoleStatus', 3);
                    commit('setUserRoleMessageErrors', err);
                });
        }
    },

    mutations: {
        setUserRole(state, usersRole) {
            state.usersRole = usersRole;
        },

        setUserRoles(state, userRoles) {
            state.userRoles = userRoles;
        },

        setLoadUserRolesStatus(state, status) {
            state.status.load = status;
        },

        setAddUserRoleStatus(state, status) {
            state.status.add = status;
        },

        setEditUserRoleStatus(state, status) {
            state.status.edit = status;
        },

        setDeleteUserRoleStatus(state, status) {
            state.status.delete = status;
        },

        setUserRoleMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
        }
    },

    getters: {
        getUserRole(state) {
            return state.usersRole;
        },

        getUserRoles(state) {
            return state.userRoles;
        },

        getLoadUserRolesStatus(state) {
            return state.status.load;
        },

        getAddUserRoleStatus(state) {
            return state.status.add;
        },

        getEditUserRoleStatus(state) {
            return state.status.edit;
        },

        getDeleteUserRoleStatus(state) {
            return state.status.delete;
        },

        getUserRoleMessageErrors(state) {
            return state.messageErrors;
        }
    }
};