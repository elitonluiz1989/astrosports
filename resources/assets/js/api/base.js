import {CONFIG} from "@js/config";

const base = {    
    serverUrl: CONFIG.API_URL,
    url: CONFIG.API_URL + "/",

    get(id)  {
        let url = id ? this.url + "/" + id : this.url;
        
        return axios.get(url);
    },

    add(data) {
        return axios.post(this.url, data);
    },

    edit(data) {
        return axios.put(this.url, data);
    },

    delete(id) {
        let url = this.url + "/delete/";
    
        let data = {
            params: {
                id: id
            }
        };
    
        return axios.delete(url, data);
    }
};


export default {
    extend(obj) {
        obj.url = base.url + obj.url;

        return Object.assign(base, obj);
    }
};
