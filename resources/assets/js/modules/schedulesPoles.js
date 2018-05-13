import schedulesApi  from '../api/schedulesPoles';

export const schedulesPoles = {
    state: {
        schedulesPole: {},
        schedulesPoles: [],
        messageErrors: null,
        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0
        }
    },

    actions: {
        loadSchedulesPole({commit}, id) {
            commit('setLoadSchedulesPolesStatus', 1);

            schedulesApi.get(id)
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedulesPole', {});
                        commit('setLoadSchedulesPolesStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedulesPole', response.data);
                        commit('setLoadSchedulesPolesStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedulesPole', {});
                    commit('setLoadSchedulesPolesStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        },

        loadSchedulesPoles({commit}) {
            commit('setLoadSchedulesPolesStatus', 1);

            schedulesApi.get()
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedulesPoles', []);
                        commit('setLoadSchedulesPolesStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedulesPoles', response.data);
                        commit('setLoadSchedulesPolesStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedulesPoles', []);
                    commit('setLoadSchedulesPolesStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        },

        addSchedulesPole({commit, dispatch}, pole) {
            commit('setAddSchedulesPoleStatus', 1);

            schedulesApi.add(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setAddSchedulesPoleStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setAddSchedulesPoleStatus', 2);
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setAddSchedulesPoleStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        },

        editSchedulesPole({commit, dispatch}, pole) {
            commit('setEditSchedulesPoleStatus', 1);

            schedulesApi.edit(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setEditSchedulesPoleStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setEditSchedulesPoleStatus', 2);
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setEditSchedulesPoleStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        },

        deleteSchedulesPole({commit, dispatch}, pole) {
            commit('setDeleteSchedulesPoleStatus', 1);

            schedulesApi.edit(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setDeleteSchedulesPoleStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setDeleteSchedulesPoleStatus', 2);
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setEditSchedulesPoleStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        }
    },

    mutations: {
        setSchedulesPole(state, schedulesPole) {
            state.schedulesPole = schedulesPole;
        },

        setSchedulesPoles(state, schedulesPoles) {
            state.schedulesPoles = schedulesPoles;
        },

        setLoadSchedulesPolesStatus(state, status) {
            state.status.load = status;
        },

        setAddSchedulesPoleStatus(state, status) {
            state.status.add = status;
        },

        setEditSchedulesPoleStatus(state, status) {
            state.status.edit = status;
        },

        setDeleteSchedulesPoleStatus(state, status) {
            state.status.delete = status;
        },

        setSchedulesPolesMessageErrors(state, message) {
            state.messageErrors = message;
        }
    },

    getters: {
        getSchedulesPole(state) {
            return state.schedulesPole;
        },

        getSchedulesPoles(state) {
            return state.schedulesPoles;
        },

        getLoadSchedulesPolesStatus(state) {
            return state.status.load;
        },

        getAddSchedulesPoleStatus(state) {
            return state.status.add;
        },

        getEditSchedulesPoleStatus(state) {
            return state.status.edit;
        },

        getDeleteSchedulesPoleStatus(state) {
            return state.status.delete;
        },

        getSchedulesPolesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};