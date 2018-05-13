import {CONFIG} from '../config';

export default {
    url: CONFIG.API_URL + '/schedules-categories',

    get(id) {
        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    add(category) {
        return axios.post(this.url, category);
    },

    edit(category) {
        return axios.put(this.url, category);
    }
}