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
            if (this.isObject(this.record[item])) {
                // Probably is an object that result of entities models relationship
                // tries get id
                return this.record[item]['id'] || this.record[item];
            } else {
                return this.record[item];
            }
        },

        manageFormData() {
            for (let item in this.fields) {
                let data = this.getRecordData(item);

                if (this.isNullOrUndefined(data) &&
                    !this.isNullOrUndefined(this.rules[item])) {
                    data = this.rules[item];
                }

                if (this.isString(data)) {
                    data = this.capitalize(data);
                }

                this.fields[item] = data;
            }
        },

        setUpadeData() {
            let proceed = false;

            for (let item in this.fields) {
                let recordData = this.getRecordData(item);

                if (this.fields[item] != recordData) {
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
}
