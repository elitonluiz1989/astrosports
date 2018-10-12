import {CONFIG} from '@js/config';

export default {
    url: CONFIG.API_URL + '/user-grants',

    get(id) {

        if (id) {
            this.url += '/' + id;
        }

        return axios.get(this.url);
    },

    add(grant) {
        return axios.post(this.url, grant);
    },

    edit(grant) {
        return axios.put(this.url, grant);
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