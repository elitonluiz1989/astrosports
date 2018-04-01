import schedulesApi  from '../api/schedulesPoles';

export const schedulesPoles = {
    state: {
        schedulesPole: {},
        schedulesPoles: [],
        messageErrors: null,
        loadSchedulesPolesStatus: 0,
        addSchedulesPolesStatus: 0
    },

    actions: {
        loadSchedulesPole({commit}, id) {
            commit('setLoadSchedulesPolesStatus', 1);

            schedulesApi.getSchedulesPoles(id)
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

            schedulesApi.getSchedulesPoles()
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

            schedulesApi.addSchedulesPole(pole)
                .then(response => {
                    if (response.data.error) {
                        commit('setAddSchedulesPolesStatus', 3);
                        commit('setSchedulesPolesMessageErrors', response.data.error);
                    } else {
                        commit('setAddSchedulesPolesStatus', 2)
                        dispatch("loadSchedulesPoles");
                    }
                })
                .catch(err => {
                    commit('setAddSchedulesPolesStatus', 3);
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
            state.schedulesPolesRequestStatus = status;
        },

        setAddSchedulesPolesStatus(state, status) {
            state.addSchedulesPolesStatus = status;
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

        getSchedulesPolesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};