import DashboardFormMixin from './DashboardFormMixin';

export default {
    mixins: [
        DashboardFormMixin
    ],

    watch: {
        editStatus(value) {
            this.watchSubmitStatus(value);

            if (value.code === 3) {
                this.disableForm(false);
            }
        },

        loadStatus(value) {
            this.watchRecordLoad(value, this.editStatus.code);
        },

        recordKey(value) {
            if (value !== null) {
                this.manageFormData();
            }
        }
    },

    mounted() {
        $("#" + this.modalId).on('show.bs.modal', () => {
            this.disableForm(false);
        });
    },

    methods: {
        getRecordData(item) {
            let data = null;
            if (this.isObject(this.record[item])) {
                // Probably is an object that result of entities models relationship
                // tries get id
                data = this.record[item].id || this.record[item];
            } else {
                data = this.record[item];
            }

            // This validate is necessary because any cases the value can be undefined
            return data || null;
        },

        manageFormData() {
            for (let item in this.fields) {
                let data = this.getRecordData(item);

                if (this.isNullOrUndefined(data)) {
                    data = this.rules[item] || null;
                }

                this.fields[item] = data;
            }
        },

        setUpdateData() {
            let proceed = false;

            for (let item in this.fields) {
                let recordData = this.getRecordData(item);

                if (this.fields[item] !== recordData) {
                    this.formData[item] = this.fields[item];

                    proceed = true;
                }
            }

            return proceed;
        },

        watchRecordLoad(status, submitRequestStatus) {
            if (status === 2) {
                if (submitRequestStatus === 2) {
                    this.manageFormData();

                    this.disableForm(false);
                }
            } else if (status === 3) {
                this.formMessageType = "error";
                this.formMessageText = "Houve um erro ao carregar os registros. O formulário deverá ser fechado.";
            }
        }
    }
};
