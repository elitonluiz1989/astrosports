import api from "@js/api/commission/commission";
import base from "../base";

export const commission = base.extend({
    actions: {
        load({commit}) {
            commit("setStatus", ["load", 1]);

            api.get()
                .then(response => {
                    commit("setRecords", response.data.data);
                    commit("setPagination", response.data);
                    commit("setStatus", ["load", 2]);
                })
                .catch(err => {
                    commit("setRecords", []);
                    commit("setPagination", null);
                    commit("setStatus", ["load", 3, err]);
                });
        },

        add({commit, dispatch}, commission) {
            commit("setStatus", ["add", 1]);

            api.add(commission)
                .then(response => {
                    commit("setStatus", ["add", 2]);
                    dispatch("load");
                })
                .catch(err => {
                    commit("setStatus", ["add", 3, err]);
                });
        },

        edit({commit, dispatch}, commission) {
            commit("setStatus", ["edit", 1]);

            api.edit(commission)
                .then(response => {
                    commit("setStatus", ["edit", 2]);
                    dispatch("load");
                })
                .catch(err => {
                    commit("setStatus", ["edit", 3, err]);
                });
        },

        delete({commit, dispatch}, id) {
            commit("setStatus", ["delete", 1]);

            api.delete(id)
                .then(() => {
                    commit("setStatus", ["delete", 2]);
                    dispatch("load");
                })
                .catch(err => {
                    commit("setStatus", ["delete", 3, err]);
                });
        }
    }
});
