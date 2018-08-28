import server  from '@js/api/users/userRoles';
import base from '../base';

export const userRoles = base.extend({
    actions: {
        load({commit}) {
            commit('setStatus', ['load', 1]);

            server.get()
                .then(response => {
                    commit('setRecords', response.data);
                    commit('setStatus', ['load', 2]);
                })
                .catch(err => {
                    commit('setRecords', []);
                    commit('setStatus', ['load', 3, err]);
                });
        },

        add({commit, dispatch}, role) {
            commit('setStatus', ['add', 1]);

            server.add(role)
                .then(response => {
                    commit('setStatus', ['add', 2]);
                    dispatch("load");
                })
                .catch(err => {
                    commit('setStatus', ['add', 3, err]);
                });
        },

        edit({commit, dispatch}, role) {
            commit('setStatus', ['edit', 1]);

            server.edit(role)
                .then(response => {
                    dispatch("load");
                    dispatch("users/load", null, {root: true});
                })
                .catch(err => {
                    commit('setStatus', ['edit', 3, err]);
                });
        },

        delete({commit, dispatch}, id) {
            commit('setStatus', ['delete', 1]);

            server.del(id)
                .then(response => {
                    commit('setStatus', ['delete', 2]);
                    dispatch("load");
                    dispatch("users/load", null, {root: true});
                })
                .catch(err => {
                    commit('setStatus', ['delete', 3, err]);
                });
        }
    },
});
