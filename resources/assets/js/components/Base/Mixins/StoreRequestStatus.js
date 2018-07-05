import { CONFIG } from "@js/config";
import {messageErrorHandler} from "@js/messageErrorHandler";

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
            status.messages = storeGetterMessage ? this.$store.getters[storeGetterMessage] : [];

            if (status.code === 3 && status.messages !== undefined) {
                if (status.messages.response !== undefined) {
                    status.messages = messageErrorHandler(status.messages.response);
                } else {
                    status.messages = messageErrorHandler(status.messages);
                }
            }

            return status;
        }
    }
}