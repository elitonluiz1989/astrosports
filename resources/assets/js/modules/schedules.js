import schedulesApi  from "../api/schedules";

export const schedules = {
    state: {
        schedule: {},
        schedules: [],
        messageErrors: null,
        loadSchedulesStatus: 0,
        addScheduleStatus: 0,
        editScheduleStatus: 0,
        deleteScheduleStatus: 0
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
        },

        editSchedule({commit, dispatch}, schedule) {
            commit("setEditScheduleStatus", 1);

            schedulesApi.editSchedule(schedule)
                .then(response => {
                    if (response.data.error) {
                        commit("setEditScheduleStatus", 3);
                        commit("setSchedulesMessageErrors", response.data.error);
                    } else {
                        commit("setEditScheduleStatus", 2);
                        dispatch("loadSchedules")
                    }
                })
                .catch(err => {
                    commit("setEditScheduleStatus", 3);
                    commit("setSchedulesMessageErrors", err);
                });
        },

        deleteSchedule({commit, dispatch}, id) {
            commit("setDeleteScheduleStatus", 1);

            schedulesApi.deleteSchedule(id)
                .then(response => {
                    if (response.data.error) {
                        commit("setDeleteScheduleStatus", 3);
                        commit("setSchedulesMessageErrors", response.data.error);
                    } else {
                        commit("setDeleteScheduleStatus", 2);
                        dispatch("loadSchedules")
                    }
                })
                .catch(err => {
                    commit("setDeleteScheduleStatus", 3);
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

        setEditScheduleStatus(state, status) {
            state.editScheduleStatus = status;
        },

        setDeleteScheduleStatus(state, status) {
            state.deleteScheduleStatus = status;
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

        getEditScheduleStatus(state) {
            return state.editScheduleStatus;
        },

        getDeleteScheduleStatus(state) {
            return state.deleteScheduleStatus;
        },

        getSchedulesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};