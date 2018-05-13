import categoriesApi  from '../api/schedulesCategories';

export const schedulesCategories = {
    state: {
        schedulesCategory: {},
        schedulesCategories: [],
        messageErrors: null,
        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0
        }
    },

    actions: {
        loadSchedulesCategory({commit}, id) {
            commit('setLoadSchedulesCategoriesStatus', 1);

            categoriesApi.get(id)
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedulesCategory', {});
                        commit('setLoadSchedulesCategoriesStatus', 3);
                        commit('setSchedulesCategoriesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedulesCategory', response.data);
                        commit('setLoadSchedulesCategoriesStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedulesCategory', {});
                    commit('setLoadSchedulesCategoriesStatus', 3);
                    commit('setSchedulesCategoriesMessageErrors', err);
                });
        },

        loadSchedulesCategories({commit}) {
            commit('setLoadSchedulesCategoriesStatus', 1);

            categoriesApi.get()
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedulesCategories', []);
                        commit('setLoadSchedulesCategoriesStatus', 3);
                        commit('setSchedulesCategoriesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedulesCategories', response.data);
                        commit('setLoadSchedulesCategoriesStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedulesCategories', []);
                    commit('setLoadSchedulesCategoriesStatus', 3);
                    commit('setSchedulesCategoriesMessageErrors', err);
                });
        },

        addSchedulesCategory({commit, dispatch}, category) {
            commit('setAddSchedulesCategoryStatus', 1);

            categoriesApi.add(category)
                .then(response => {
                    if (response.data.error) {
                        commit('setAddSchedulesCategoryStatus', 3);
                        commit('setSchedulesCategoriesMessageErrors', response.data.error);
                    } else {
                        commit('setAddSchedulesCategoryStatus', 2);
                        dispatch("loadSchedulesCategories");
                    }
                })
                .catch(err => {
                    commit('setAddSchedulesCategoryStatus', 3);
                    commit('setSchedulesCategoriesMessageErrors', err);
                });
        },

        editSchedulesCategory({commit, dispatch}, category) {
            commit('setEditSchedulesCategoryStatus', 1);

            categoriesApi.edit(category)
                .then(response => {
                    if (response.data.error) {
                        commit('setEditSchedulesCategoryStatus', 3);
                        commit('setSchedulesCategoriesMessageErrors', response.data.error);
                    } else {
                        commit('setEditSchedulesCategoryStatus', 2);
                        dispatch("loadSchedulesCategories");
                    }
                })
                .catch(err => {
                    commit('setEditSchedulesCategoryStatus', 3);
                    commit('setSchedulesCategoriesMessageErrors', err);
                });
        }
    },

    mutations: {
        setSchedulesCategory(state, schedulesCategory) {
            state.schedulesCategory = schedulesCategory;
        },

        setSchedulesCategories(state, schedulesCategories) {
            state.schedulesCategories = schedulesCategories;
        },

        setLoadSchedulesCategoriesStatus(state, status) {
            state.status.load = status;
        },

        setAddSchedulesCategoryStatus(state, status) {
            state.status.add = status;
        },

        setEditSchedulesCategoryStatus(state, status) {
            state.status.edit = status;
        },

        setSchedulesCategoriesMessageErrors(state, message) {
            state.messageErrors = message;
        }
    },

    getters: {
        getSchedulesCategory(state) {
            return state.schedulesCategory;
        },

        getSchedulesCategories(state) {
            return state.schedulesCategories;
        },

        getLoadSchedulesCategoriesStatus(state) {
            return state.status.load;
        },

        getAddSchedulesCategoryStatus(state) {
            return state.status.add;
        },

        getEditSchedulesCategoryStatus(state) {
            return state.status.edit;
        },

        getSchedulesCategoriesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};