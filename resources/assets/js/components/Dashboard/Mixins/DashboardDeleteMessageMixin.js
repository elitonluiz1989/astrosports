import ModalMixin from '@components/Base/Mixins/ModalMixin';
import AppMask from '@components/Base/AppMask';
import StoreRequestStatus from '@components/Base/Mixins/StoreRequestStatus';

export default {
    components: {
        AppMask
    },

    mixins: [
        ModalMixin,
        StoreRequestStatus
    ],

    props: {
        recordId: {
            type: Number,
            required: true
        },

        typeRecord: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            showMask: false,
            showRequestResult: false,
            showRequestMessage: false,
            requestMessage: "",
            modalText: {},
            messages: {}
        };
    },

    computed: {
        modalMessage() {
            return this.modalText[this.typeRecord];
        }
    },

    created() {
        this.modalId = "Dashboard-" + this.typeRecord + "-delete-modal";
    },

    watch: {
        deleteStatus(value) {
            if (value.code > 1) {
                this.showMask = false;
                this.showRequestResult = true;
                this.requestMessage = this.messages[this.typeRecord][value.code];
            }
        }
    },

    methods: {
        hideModal() {
            if (!this.showMask) {
                this.showRequestResult = false;

                this.$emit('hideModal');
            }
        }
    }
}
