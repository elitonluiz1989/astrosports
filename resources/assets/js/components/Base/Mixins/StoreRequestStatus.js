export default {
    data() {
        return {
            requestMessageOnLog: false
        };
    },

    methods: {
        storeRequestStatus(storeGetterCode, storeGetterMessage) {
            let status = {};

            status.code =  this.$store.getters[storeGetterCode];
            status.message = storeGetterMessage ? this.$store.getters[storeGetterMessage] : null;

            if (status.code === 3 && this.requestMessageOnLog) {
                console.log(status.message);
            }

            return status;
        }
    }
}