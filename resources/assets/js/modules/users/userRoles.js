import schedulesApi  from '@js/api/users/usersRoles';
import {messageErrorHandler} from "@js/messageErrorHandler";

export const usersRoles = {
    state: {
        usersRole: {},
        usersRoles: [],
        messageErrors: null,
        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0
        }
    },

    actions: {
        loadUsersRole({commit}, id) {
            commit('setLoadUsersRolesStatus', 1);

            schedulesApi.get(id)
                .then(response => {
                    commit('setUsersRole', response.data);
                    commit('setLoadUsersRolesStatus', 2);
                })
                .catch(err => {
                    commit('setUsersRole', {});
                    commit('setLoadUsersRolesStatus', 3);
                    commit('setUsersRolesMessageErrors', err);
                });
        },

        loadUsersRoles({commit}) {
            commit('setLoadUsersRolesStatus', 1);

            schedulesApi.get()
                .then(response => {
                    commit('setUsersRoles', response.data);
                    commit('setLoadUsersRolesStatus', 2);
                })
                .catch(err => {
                    commit('setUsersRoles', []);
                    commit('setLoadUsersRolesStatus', 3);
                    commit('setUsersRolesMessageErrors', err);
                });
        },

        addUsersRole({commit, dispatch}, role) {
            commit('setAddUsersRoleStatus', 1);

            schedulesApi.add(role)
                .then(response => {
                    commit('setAddUsersRoleStatus', 2);
                    dispatch("loadUsersRoles");
                })
                .catch(err => {
                    commit('setAddUsersRoleStatus', 3);
                    commit('setUsersRolesMessageErrors', err);
                });
        },

        editUsersRole({commit, dispatch}, role) {
            commit('setEditUsersRoleStatus', 1);

            schedulesApi.edit(role)
                .then(response => {
                    commit('setEditUsersRoleStatus', 2);
                    dispatch("loadUsersRoles");
                    dispatch("loadSchedules");
                })
                .catch(err => {
                    commit('setEditUsersRoleStatus', 3);
                    commit('setUsersRolesMessageErrors', err);
                });
        },

        deleteUsersRole({commit, dispatch}, id) {
            commit('setDeleteUsersRoleStatus', 1);

            schedulesApi.del(id)
                .then(response => {
                    commit('setDeleteUsersRoleStatus', 2);
                    dispatch("loadUsersRoles");
                    dispatch("loadSchedules");
                })
                .catch(err => {
                    commit('setDeleteUsersRoleStatus', 3);
                    commit('setUsersRolesMessageErrors', err);
                });
        }
    },

    mutations: {
        setUsersRole(state, usersRole) {
            state.usersRole = usersRole;
        },

        setUsersRoles(state, usersRoles) {
            state.usersRoles = usersRoles;
        },

        setLoadUsersRolesStatus(state, status) {
            state.status.load = status;
        },

        setAddUsersRoleStatus(state, status) {
            state.status.add = status;
        },

        setEditUsersRoleStatus(state, status) {
            state.status.edit = status;
        },

        setDeleteUsersRoleStatus(state, status) {
            state.status.delete = status;
        },

        setUsersRolesMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
        }
    },

    getters: {
        getUsersRole(state) {
            return state.usersRole;
        },

        getUsersRoles(state) {
            return state.usersRoles;
        },

        getLoadUsersRolesStatus(state) {
            return state.status.load;
        },

        getAddUsersRoleStatus(state) {
            return state.status.add;
        },

        getEditUsersRoleStatus(state) {
            return state.status.edit;
        },

        getDeleteUsersRoleStatus(state) {
            return state.status.delete;
        },

        getUsersRolesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};