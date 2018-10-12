import { capitalize, cleanArray, isArray, isEmptyArray, isEmptyString, isNullOrUndefined, isObject, isString } from './utils';

const VueUtils = {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                capitalize,

                cleanArray,

                isArray,

                isEmptyArray,

                isEmptyString,

                isNullOrUndefined,

                isObject,

                isSelfDefined(value) {
                    // Function to validate self-defined attributes on Vue Components
                    return value !== undefined && value !== false;
                },

                isString,

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
                    if (!this.isEmptyString(this.$store.getters.getAuthUserGrant) && this.$store.getters.getAuthUserGrant > 0) {
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
