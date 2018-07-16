import {CONFIG} from '@js/config';

export default {
    url: CONFIG.API_URL + '/users-roles',

    get(id) {

        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    add(role) {
        return axios.post(this.url, role);
    },

    edit(role) {
        return axios.put(this.url, role);
    },

    del(id) {
        let url = this.url + '/delete/';

        let data = {
            params: {
                id: id
            }
        };

        return axios.delete(url, data);
    }
}