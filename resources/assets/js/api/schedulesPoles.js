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
        return axios.post(this.url, pole);
    },

    del(id) {
        let url = this.url + '/delete/?id=' + id;

        return axios.get(url);
    }
}