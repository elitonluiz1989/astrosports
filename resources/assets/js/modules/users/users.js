import api from "@js/api/users/users";
import base from "../base";

export const users = base.extend({
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

        add({commit, dispatch}, user) {
            commit("setStatus", ["add", 1]);

            api.add(user)
                .then(response => {
                    commit("setStatus", ["add", 2]);
                    dispatch("load");
                })
                .catch(err => {
                    commit("setStatus", ["add", 3, err]);
                });
        },

        edit({commit, dispatch}, user) {
            commit("setStatus", ["edit", 1]);

            api.edit(user)
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
