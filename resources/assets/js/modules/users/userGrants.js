import schedulesApi  from '@js/api/users/userGrants';
import {messageErrorHandler} from "@js/messageErrorHandler";

export const userGrants = {
    state: {
        userGrant: {},
        userGrants: [],
        messageErrors: null,
        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0
        }
    },

    actions: {
        loadUserGrant({commit}, id) {
            commit('setLoadUserGrantsStatus', 1);

            schedulesApi.get(id)
                .then(response => {
                    commit('setUserGrant', response.data);
                    commit('setLoadUserGrantsStatus', 2);
                })
                .catch(err => {
                    commit('setUserGrant', {});
                    commit('setLoadUserGrantsStatus', 3);
                    commit('setUserGrantMessageErrors', err);
                });
        },

        loadUserGrants({commit}) {
            commit('setLoadUserGrantsStatus', 1);

            schedulesApi.get()
                .then(response => {
                    commit('setUserGrants', response.data);
                    commit('setLoadUserGrantsStatus', 2);
                })
                .catch(err => {
                    commit('setUserGrants', []);
                    commit('setLoadUserGrantsStatus', 3);
                    commit('setUserGrantMessageErrors', err);
                });
        },

        addUserGrant({commit, dispatch}, role) {
            commit('setAddUserGrantStatus', 1);

            schedulesApi.add(role)
                .then(response => {
                    commit('setAddUserGrantStatus', 2);
                    dispatch("loadUserGrants");
                })
                .catch(err => {
                    commit('setAddUserGrantStatus', 3);
                    commit('setUserGrantMessageErrors', err);
                });
        },

        editUserGrant({commit, dispatch}, role) {
            commit('setEditUserGrantStatus', 1);

            schedulesApi.edit(role)
                .then(response => {
                    commit('setEditUserGrantStatus', 2);
                    dispatch("loadUserGrants");
                    dispatch("loadUsers");
                })
                .catch(err => {
                    commit('setEditUserGrantStatus', 3);
                    commit('setUserGrantMessageErrors', err);
                });
        },

        deleteUserGrant({commit, dispatch}, id) {
            commit('setDeleteUserGrantStatus', 1);
            console.log(id);

            schedulesApi.del(id)
                .then(response => {
                    console.log(response)
                    commit('setDeleteUserGrantStatus', 2);
                    dispatch("loadUserGrants");
                    dispatch("loadUsers");
                })
                .catch(err => {
                    commit('setDeleteUserGrantStatus', 3);
                    commit('setUserGrantMessageErrors', err);
                });
        }
    },

    mutations: {
        setUserGrant(state, userGrant) {
            state.userGrant = userGrant;
        },

        setUserGrants(state, userGrants) {
            state.userGrants = userGrants;
        },

        setLoadUserGrantsStatus(state, status) {
            state.status.load = status;
        },

        setAddUserGrantStatus(state, status) {
            state.status.add = status;
        },

        setEditUserGrantStatus(state, status) {
            state.status.edit = status;
        },

        setDeleteUserGrantStatus(state, status) {
            state.status.delete = status;
        },

        setUserGrantMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
        }
    },

    getters: {
        getUserGrant(state) {
            return state.userGrant;
        },

        getUserGrants(state) {
            return state.userGrants;
        },

        getLoadUserGrantsStatus(state) {
            return state.status.load;
        },

        getAddUserGrantStatus(state) {
            return state.status.add;
        },

        getEditUserGrantStatus(state) {
            return state.status.edit;
        },

        getDeleteUserGrantStatus(state) {
            return state.status.delete;
        },

        getUserGrantMessageErrors(state) {
            return state.messageErrors;
        }
    }
};