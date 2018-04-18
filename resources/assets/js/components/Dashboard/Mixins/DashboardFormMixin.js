export default {
    data() {
        return {
            formName: "schedules-form",
            record: {}
        };
    },

    props: {
        type: {
            type: String,
            default: "insert"
        },

        recordKey: {
            type: Number
        },

        hiddenShowButton: {
            type: Boolean,
            default: false
        }
    },

    computed: {
        formId() {
            return this.formName + this.type;
        },

        styles() {
            return {
                formHeader: {
                    "modal-header form-header--insert": this.type === "insert",
                    "modal-header form-header--edit": this.type === "edit",
                },
                label: "control-label col-3",
                inputGroup: "input-group col-9",
                btnSubmit: {
                    "btn btn-success": this.type === "insert",
                    "btn btn-danger": this.type === "edit",
                }
            };
        }
    },

    watch: {
        triggerShow(value) {
            if (value) {
                this.$refs.showFormBtn.click();
            }
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