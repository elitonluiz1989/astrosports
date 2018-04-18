import {CONFIG} from '../config';

export default {
    url: CONFIG.API_URL + '/schedules',

    getSchedules(id) {
        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    addSchedule(schedule) {
        return axios.post(this.url, schedule);
    },

    editSchedule(schedule) {
        return axios.put(this.url, schedule);
    },

    deleteSchedule(id) {
        this.url += '/deletar/' + id;
        return axios.delete(this.url);
    }
}