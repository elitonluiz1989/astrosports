export default {
    data() {
        return {
            formName: "schedules-form",
        };
    },

    props: {
        recordId: {
            type: Number
        }
    },

    computed: {
        formId() {
            return this.recordId ? this.formName + "-edit" : this.formName + "-insert";
        },
        styles() {
            return {
                label: "control-label col-3",
                inputGroup: "input-group col-9",
                btnSubmit: {
                    "btn btn-success": !this.recordId,
                    "btn btn-danger": this.recordId,
                }
            };
        }
    },

    methods: {
        setFieldId(field) {
            return this.formId + '-' + field;
        },

        watchSubmitStatus(value, messageSuccess, messageError) {
            if (value.code === 2) {
                this.showMessageSuccess(messageSuccess);
            } else if (value.code === 3) {
                this.showMessageError(messageError);
            }
        }
    }
}