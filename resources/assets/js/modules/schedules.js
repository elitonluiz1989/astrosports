import schedulesApi  from "../api/schedules";

export const schedules = {
    state: {
        schedule: {},
        schedules: [],
        messageErrors: null,
        loadSchedulesStatus: 0,
        addScheduleStatus: 0
    },

    actions: {
        loadSchedule({commit}, id) {
            commit("setLoadSchedulesStatus", 1);

            schedulesApi.getSchedules(id)
                .then(response => {
                    if (response.data.error) {
                        commit("setSchedule", {});
                        commit("setLoadSchedulesStatus", 3);
                        commit("setSchedulesMessageErrors", response.data.error);
                    } else {
                        commit("setSchedule", response.data);
                        commit("setLoadSchedulesStatus", 2)
                    }
                })
                .catch(err => {
                    commit("setSchedule", {});
                    commit("setLoadSchedulesStatus", 3);
                    commit("setSchedulesMessageErrors", err);
                });
        },

        loadSchedules({commit}) {
            commit("setLoadSchedulesStatus", 1);

            schedulesApi.getSchedules()
                .then(response => {
                    if (response.data.error) {
                        commit("setSchedules", []);
                        commit("setLoadSchedulesStatus", 3);
                        commit("setSchedulesMessageErrors", response.data.error);
                    } else {
                        commit("setSchedules", response.data);
                        commit("setLoadSchedulesStatus", 2)
                    }
                })
                .catch(err => {
                    commit("setSchedules", []);
                    commit("setLoadSchedulesStatus", 3);
                    commit("setSchedulesMessageErrors", err);
                });
        },

        addSchedule({commit, dispatch}, schedule) {
            commit("setAddScheduleStatus", 1);

            schedulesApi.addSchedule(schedule)
                .then(response => {
                    if (response.data.error) {
                        commit("setAddScheduleStatus", 3);
                        commit("setSchedulesMessageErrors", response.data.error);
                    } else {
                        commit("setAddScheduleStatus", 2);
                        dispatch("loadSchedules")
                    }
                })
                .catch(err => {
                    commit("setAddScheduleStatus", 3);
                    commit("setSchedulesMessageErrors", err);
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

        setLoadSchedulesStatus(state, status) {
            state.loadSchedulesStatus = status;
        },

        setAddScheduleStatus(state, status) {
            state.addScheduleStatus = status;
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

        getLoadSchedulesStatus(state) {
            return state.loadSchedulesStatus;
        },

        getAddScheduleStatus(state) {
            return state.addScheduleStatus;
        },

        getSchedulesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};