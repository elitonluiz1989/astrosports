import schedulesApi  from '../api/schedulesCategories';

export const schedulesCategories = {
    state: {
        schedulesCategory: {},
        schedulesCategories: [],
        messageErrors: null,
        loadSchedulesCategoriesStatus: 0,
        addSchedulesCategoryStatus: 0
    },

    actions: {
        loadSchedulesCategory({commit}, id) {
            commit('setLoadSchedulesCategoriesStatus', 1);

            schedulesApi.getSchedulesPoles(id)
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

            schedulesApi.getSchedulesCategories()
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

            schedulesApi.addSchedulesCategory(category)
                .then(response => {
                    if (response.data.error) {
                        commit('setAddSchedulesCategoryStatus', 3);
                        commit('setSchedulesCategoriesMessageErrors', response.data.error);
                    } else {
                        commit('setAddSchedulesCategoryStatus', 2)
                        dispatch("loadSchedulesCategories");
                    }
                })
                .catch(err => {
                    commit('setAddSchedulesCategoryStatus', 3);
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
            state.loadSchedulesCategoriesStatus = status;
        },

        setAddSchedulesCategoryStatus(state, status) {
            state.addSchedulesCategoryStatus = status;
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
            return state.loadSchedulesCategoriesStatus;
        },

        getAddSchedulesCategoryStatus(state) {
            return state.addSchedulesCategoryStatus;
        },

        getSchedulesCategoriesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};