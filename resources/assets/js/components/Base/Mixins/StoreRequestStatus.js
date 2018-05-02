import { CONFIG } from "../../../config";

export default {
    data() {
        return {
            requestMessageOnLog: CONFIG.REQUEST_MESSAGE_ON_LOG
        };
    },

    methods: {
        storeRequestStatus(storeGetterCode, storeGetterMessage) {
            let status = {};
            status.code =  this.$store.getters[storeGetterCode];
            status.message = storeGetterMessage ? this.$store.getters[storeGetterMessage] : null;
            status.showUser = [];

            if (status.code === 3 && this.requestMessageOnLog && status.message !== null && status.message !== undefined) {
                if (status.message.response &&
                    status.message.response.status &&
                    status.message.response.status === 422 &&
                    status.message.response.data.errors) {
                    let errors = status.message.response.data.errors;

                    for (let key in errors) {
                        for (let subKey in errors[key]) {
                            let message = errors[key][subKey]

                            if (message.indexOf("[show-user]") !== -1) {
                                message = message.replace("[show-user]", "");
                                status.showUser.push(message)
                            }

                            message = key + '[' + subKey + ']: ' + message;

                            console.error(message);
                        }
                    }

                    status.message = errors;
                } else {
                    console.error(status.message)
                }
            }

            return status;
        }
    }
}