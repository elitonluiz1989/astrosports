import {CONFIG} from "@js/config";

export default {
    extend(obj) {
        return Object.assign(
            {    
                serverUrl: CONFIG.API_URL,
                baseUrl: CONFIG.API_URL + "/",
                endpoint: "",
            
                getUrl(params) {
                    let url = this.baseUrl + this.endpoint;

                    if (params)
                    {
                        url = url + '/' + params;
                    }

                    return url;
                },
            
                get(id)  {
                    let url = this.getUrl(id);
                    
                    return axios.get(url);
                },
            
                add(data) {
                    return axios.post(this.getUrl(), data);
                },
            
                edit(data) {
                    return axios.post(this.getUrl(), data);
                },
            
                delete(id) {
                    let url = this.getUrl('delete/?id=' + id);

                    return axios.get(url);
                }
            }, 
            obj);
    }
};
