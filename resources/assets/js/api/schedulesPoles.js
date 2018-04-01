import {CONFIG} from '../config';

export default {
    url: CONFIG.API_URL + '/schedules-poles',

    getSchedulesPoles(id) {

        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    addSchedulesPole(pole) {
        return axios.post(this.url, pole);
    }
}