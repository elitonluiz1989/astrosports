const Utils = {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                isArray(value) {
                    return value instanceof Array;
                },

                isNullOrEmpty(string) {
                    return string === undefined || string === null || string === "";
                },

                isObject(value) {
                    return value instanceof Object;
                },

                isSelfDefined(value) {
                    // Function to validate self-defined attributes on Vue Components
                    return value !== undefined && value !== false;
                }
            }
        });
    }
};

export default Utils;