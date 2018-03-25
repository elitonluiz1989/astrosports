import {CONFIG} from '../config';

export default {
    getAuthUser() {
        return axios.get(CONFIG.API_URL + '/user');
    },

    getUsers(id) {
        let url = CONFIG.API_URL + '/users';

        if (id) {
            url += '/' + id;
        }

        return axios.get(url);
    }
}