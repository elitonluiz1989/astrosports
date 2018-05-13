import DashboardFormMixin from './DashboardFormMixin';

export default {
    mixins: [
        DashboardFormMixin
    ],

    watch: {
        recordKey(value) {
            if (value !== null) {
                this.manageFormData(); // This method must be implemented in Vue component that include this mixin
            }
        }
    },

    methods: {
        watchRecordLoad(status, submitRequestStatus, recordIdentifier) {
            if (status === 2) {
                if (submitRequestStatus === 2) {
                    this.manageFormData();

                    this.disableForm(false);
                }
            } else if (status === 3) {
                this.formMessageType = "error";
                this.formMessageText = "Houve um erro ao carregar " + recordIdentifier + ". O formulário deverá ser fechado.";
            }
        }
    }
}