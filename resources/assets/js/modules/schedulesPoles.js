import schedulesApi  from '../api/schedulesPoles';

export const schedulesPoles = {
    state: {
        schedulesPole: {},
        schedulesPoles: [],
        messageErrors: null,
        loadSchedulesPolesStatus: 0,
        addSchedulesPolesStatus: 0,
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
            commit('setAddSchedulesPolesStatus', 1);

            schedulesApi.add(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setAddSchedulesPolesStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setAddSchedulesPolesStatus', 2);
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setAddSchedulesPolesStatus', 3);
                    commit('setSchedulesPolesMessageErrors', err);
                });
        },

        editSchedulesPole({commit, dispatch}, pole) {
            commit('setEditSchedulesPolesStatus', 1);

            schedulesApi.edit(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setEditSchedulesPolesStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setEditSchedulesPolesStatus', 2);
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setEditSchedulesPolesStatus', 3);
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
            state.loadSchedulesPolesStatus = status;
        },

        setAddSchedulesPolesStatus(state, status) {
            state.addSchedulesPolesStatus = status;
        },

        setEditSchedulesPolesStatus(state, status) {
            state.status.edit = status;
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
            return state.loadSchedulesPolesStatus;
        },

        getAddSchedulesPolesStatus(state) {
            return state.addSchedulesPolesStatus;
        },

        getEditSchedulesPolesStatus(state) {
            return state.status.edit;
        },

        getSchedulesPolesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};