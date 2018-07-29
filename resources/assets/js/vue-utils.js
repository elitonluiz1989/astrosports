import { cleanArray, isArray, isNullOrEmpty, isNullOrUndefined, isObject } from './utils';

const VueUtils = {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                cleanArray,

                isArray,

                isNullOrEmpty,

                isNullOrUndefined,

                isObject,

                isSelfDefined(value) {
                    // Function to validate self-defined attributes on Vue Components
                    return value !== undefined && value !== false;
                },

                getRequestParam(param) {
                    console.log(this.$request.params, this.$request.params.mostrar);
                    return 'sss';
                },

                setRequestParams() {
                    let queryString = window.location.search.replace("?", "").split("&");
                    let params = [];

                    for (let param of queryString) {
                        let values = param.split("=");

                        this.$request.params[values[0]] = values[1];
                    }
                },

                userIsAllowed(userGrant, tipo) {
                    if (!this.isNullOrEmpty(this.$store.getters.getAuthUserGrant)) {
                        return this.$store.getters.getAuthUserGrant <= userGrant;
                    } else {
                        return  true;
                    }
                }
            }
        });
    }
};

export default VueUtils;