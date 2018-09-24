import server   from '@js/api/users/users';
import base from "../base";

export const users = base.extend({
    actions: {
        load({commit}) {
            commit('setStatus', ['load', 1]);

            server.get()
                .then(response => {
                    commit('setRecords', response.data.data);
                    commit('setPagination', response.data);
                    commit('setStatus', ['load', 2]);
                })
                .catch(err => {
                    commit('setRecords', []);
                    commit('setPagination', null);
                    commit('setStatus', ['load', 3, err]);
                });
        },

        add({commit, dispatch}, user) {
            commit('setStatus', ['add', 1]);

            server.add(user)
                .then(response => {
                    commit('setStatus', ['add', 2]);
                    dispatch('load');
                })
                .catch(err => {
                    commit('setStatus', ['add', 3, err]);
                });
        },

        edit({commit, dispatch}, user) {
            commit('setStatus', ['edit', 1]);

            server.edit(user)
                .then(response => {
                    commit('setStatus', ['edit', 2]);
                    dispatch('load');
                })
                .catch(err => {
                    commit('setStatus', ['edit', 3, err]);
                });
        }
    }
});
