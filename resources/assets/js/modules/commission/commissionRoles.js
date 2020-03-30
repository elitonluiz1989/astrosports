import api from '@js/api/commission/commissionRoles';
import base from '../base';

export const commissionRoles = base.extend({
    actions: {
        load({commit}) {
            commit('setStatus', ['load', 1]);

            api.get()
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

            api.add(role)
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

            api.edit(role)
                .then(response => {
                    commit('setStatus', ['edit', 2]);
                    dispatch("load");
                    dispatch("users/load", null, {root: true});
                })
                .catch(err => {
                    commit('setStatus', ['edit', 3, err]);
                });
        },

        delete({commit, dispatch}, id) {
            commit('setStatus', ['delete', 1]);

            api.delete(id)
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
