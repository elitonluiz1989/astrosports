import {CONFIG} from '../config';

export default {
    getSchedules(id) {
        let url = CONFIG.API_URL + '/schedules';

        if (id) {
            url += '/' + id;
        }

        return axios.get(url);
    }
}