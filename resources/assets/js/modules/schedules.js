import schedulesApi  from '../api/schedules';

export const schedules = {
    state: {
        schedule: {},
        schedules: [],
        messageErrors: null,
        schedulesRequestStatus: 0
    },

    actions: {
        loadSchedule({commit}, id) {
            commit('setSchedulesRequestStatus', 1);

            schedulesApi.loadSchedules(id)
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedule', {});
                        commit('setSchedulesRequestStatus', 3);
                        commit('setSchedulesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedule', response.data);
                        commit('setSchedulesRequestStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedule', {});
                    commit('setSchedulesRequestStatus', 3);
                    commit('setSchedulesMessageErrors', err);
                });
        },

        loadSchedules({commit}) {
            commit('setSchedulesRequestStatus', 1);

            schedulesApi.getSchedules()
                .then(response => {
                    if (response.data.error) {
                        commit('setSchedules', []);
                        commit('setSchedulesRequestStatus', 3);
                        commit('setSchedulesMessageErrors', response.data.error);
                    } else {
                        commit('setSchedules', response.data);
                        commit('setSchedulesRequestStatus', 2)
                    }
                })
                .catch(err => {
                    commit('setSchedules', []);
                    commit('setSchedulesRequestStatus', 3);
                    commit('setSchedulesMessageErrors', err);
                });
        }
    },

    mutations: {
        setSchedule(state, schedule) {
            state.schedule = schedule;
        },

        setSchedules(state, schedules) {
            state.schedules = schedules;
        },

        setSchedulesRequestStatus(state, status) {
            state.schedulesRequestStatus = status;
        },

        setSchedulesMessageErrors(state, message) {
            state.messageErrors = message;
        }
    },

    getters: {
        getSchedule(state) {
            return state.schedule;
        },

        getSchedules(state) {
            return state.schedules;
        },

        getSchedulesRequestStatus(state) {
            return state.schedulesRequestStatus;
        },

        getSchedulesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};