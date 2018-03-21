import {CONFIG} from '../config';

export default {
    getAuthUser() {
        return axios.get(CONFIG.REQUEST_URL + '/user');
    },

    getUsers(id) {
        let url = CONFIG.REQUEST_URL + '/users';

        if (id) {
            url += '/' + id;
        }

        return axios.get(url);
    }
}