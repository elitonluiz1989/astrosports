import categoriesApi  from '@js/api/schedulesCategories';
import {messageErrorHandler} from "@js/helpers/messageErrorHandler";

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
                    commit('setSchedulesCategory', response.data);
                    commit('setLoadSchedulesCategoriesStatus', 2);
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
                    commit('setSchedulesCategories', response.data);
                    commit('setLoadSchedulesCategoriesStatus', 2);
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
                    commit('setAddSchedulesCategoryStatus', 2);
                    dispatch("loadSchedulesCategories");
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
                    commit('setEditSchedulesCategoryStatus', 2);
                    dispatch("loadSchedulesCategories");
                    dispatch("loadSchedules");
                })
                .catch(err => {
                    commit('setEditSchedulesCategoryStatus', 3);
                    commit('setSchedulesCategoriesMessageErrors', err);
                });
        },

        deleteSchedulesCategory({commit, dispatch}, category) {
            commit('setDeleteSchedulesCategoryStatus', 1);

            categoriesApi.del(category)
                .then(response => {
                    commit('setDeleteSchedulesCategoryStatus', 2);
                    dispatch("loadSchedulesCategories");
                    dispatch("loadSchedules");
                })
                .catch(err => {
                    commit('setDeleteSchedulesCategoryStatus', 3);
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

        setDeleteSchedulesCategoryStatus(state, status) {
            state.status.delete = status;
        },

        setSchedulesCategoriesMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
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

        getDeleteSchedulesCategoryStatus(state) {
            return state.status.delete;
        },

        getSchedulesCategoriesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};