import base from '../base';

export default base.extend({
    url: 'users',

    getAuthUser() {
        return axios.get(this.serverUrl + '/user');
    }
});