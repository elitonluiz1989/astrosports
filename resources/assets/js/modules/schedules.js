import schedulesApi  from "@js/api/schedules";
import {messageErrorHandler} from "@js/helpers/messageErrorHandler";

export const schedules = {
    state: {
        schedule: {},
        schedules: [],
        messageErrors: null,
        status: {
            load: 0,
            add: 0,
            edit: 0,
            delete: 0
        }
    },

    actions: {
        loadSchedule({commit}, id) {
            commit("setLoadSchedulesStatus", 1);

            schedulesApi.getSchedules(id)
                .then(response => {
                    commit("setSchedule", response.data);
                    commit("setLoadSchedulesStatus", 2);
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
                    commit("setSchedules", response.data);
                    commit("setLoadSchedulesStatus", 2);
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
                    commit("setAddScheduleStatus", 2);
                    dispatch("loadSchedules");
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
                    commit("setEditScheduleStatus", 2);
                    dispatch("loadSchedules");
                })
                .catch(err => {
                    commit("setEditScheduleStatus", 3);
                    commit("setSchedulesMessageErrors", err);
                });
        },

        deleteSchedule({commit, dispatch}, id) {
            commit("setDeleteScheduleStatus", 1);

            schedulesApi.del(id)
                .then(response => {
                    commit("setDeleteScheduleStatus", 2);
                    dispatch("loadSchedules");
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
            state.status.load = status;
        },

        setAddScheduleStatus(state, status) {
            state.status.add = status;
        },

        setEditScheduleStatus(state, status) {
            state.status.edit = status;
        },

        setDeleteScheduleStatus(state, status) {
            state.status.delete = status;
        },

        setSchedulesMessageErrors(state, message) {
            state.messageErrors = messageErrorHandler(message);
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
            return state.status.load;
        },

        getAddScheduleStatus(state) {
            return state.status.add;
        },

        getEditScheduleStatus(state) {
            return state.status.edit;
        },

        getDeleteScheduleStatus(state) {
            return state.status.delete;
        },

        getSchedulesMessageErrors(state) {
            return state.messageErrors;
        }
    }
};