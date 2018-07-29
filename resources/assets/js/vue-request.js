const VueRequest = {
    install(Vue, options) {
        Vue.prototype.$request = {
            params: []
        };

        Vue.mixin({
            created() {
                this.setRequestParams();
            },

            methods: {
                getRequestParam(param) {
                    return this.$request.params[param] || false;
                },

                setRequestParams() {
                    let queryString = window.location.search.replace("?", "").split("&");
                    let params = [];

                    for (let param of queryString) {
                        let values = param.split("=");

                        this.$request.params[values[0]] = values[1];
                    }
                }
            }
        });
    }
};

export default VueRequest;