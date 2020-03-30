import base from '../base';

export default base.extend({
    endpoint: 'users',

    getAuthUser() {
        return axios.get(this.serverUrl + '/user');
    }
});