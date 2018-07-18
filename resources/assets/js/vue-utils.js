import { cleanArray, isArray, isNullOrEmpty, isNullOrUndefined, isObject } from './utils';

const Utils = {
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

export default Utils;