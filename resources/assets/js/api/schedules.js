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
        /* Used this way because this event is called by a button and cause a error if simply
        * concatenate like getSchedules with a id
        */
        let url = this.url + '/delete/';

        let data = {
            params: {
                id: id
            }
        }

        return axios.delete(url, data);
    }
}