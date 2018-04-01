import {CONFIG} from '../config';

export default {
    url: CONFIG.API_URL + '/schedules-categories',

    getSchedulesCategories(id) {
        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    addSchedulesCategory(category) {
        return axios.post(this.url, category);
    }
}