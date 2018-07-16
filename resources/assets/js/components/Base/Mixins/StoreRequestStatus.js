import { CONFIG } from "@js/config";

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

            return status;
        }
    }
};