import server   from '@js/api/users';
import base from "../base";

export const users = base.extend({
    state: {
        users: [],
    },

    actions: {
        load({commit}) {
            commit('setStatus', ['load', 1]);

            server .getUsers()
                .then(response => {
                    commit('setUsers', response.data.data);
                    commit('setPagination', response.data);
                    commit('setStatus', ['load', 2]);
                })
                .catch(err => {
                    commit('setUsers', []);
                    commit('setPagination', null);
                    commit('setStatus', ['load', 3, err]);
                });
        },

        add({commit, dispatch}, user) {
            commit('setStatus', ['add', 1]);

            server .add(user)
                .then(response => {
                    commit('setStatus', ['add', 3]);
                    dispatch("users/load");
                })
                .catch(err => {
                    commit('setStatus', ['add', 3, err]);
                });
        }
    },

    mutations: {
        setUsers(state, users) {
            state.users = users;
        }
    }
});
