import {CONFIG} from '../config';

export default {
    url: CONFIG.API_URL + '/schedules-poles',

    get(id) {

        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    add(pole) {
        return axios.post(this.url, pole);
    },

    edit(pole) {
        return axios.put(this.url, pole);
    }
}