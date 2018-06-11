const Utils = {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                isNullOrEmpty(string) {
                    return string === undefined || string === null || string === "";
                }
            }
        });
    }
};

export default Utils;