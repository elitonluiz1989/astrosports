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

            if (status.code === 3 && this.requestMessageOnLog && status.message !== null) {
                if (status.message.response &&
                    status.message.response.status &&
                    status.message.response.status === 422 &&
                    status.message.response.data.errors) {
                    let errors = status.message.response.data.errors;

                    for (let key in errors) {
                        for (let subKey in errors[key]) {
                            let message = key;
                            message += '[' + subKey + ']: ';
                            message += errors[key][subKey];

                            console.error(message);
                        }
                    }
                } else {
                    console.error(status.message)
                }
            }

            return status;
        }
    }
}