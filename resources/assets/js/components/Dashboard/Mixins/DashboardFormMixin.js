export default {
    data() {
        return {
            formType: "insert",
            formId: "",
            showMask: false
        };
    },

    computed: {
        styles() {
            return {
                formHeader: {
                    "modal-header form-header--insert": this.formType === "insert",
                    "modal-header form-header--edit": this.formType === "edit",
                },
                label: "control-label col-3",
                inputGroup: "input-group col-9",
                btnSubmit: {
                    "btn btn-success": this.formType === "insert",
                    "btn btn-danger": this.formType === "edit",
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
        disableForm(disable) {
            disable = disable === undefined;

            $("#" + this.formId).find('input, select').each(function (item) {
                this.disabled = disable;
            });
        },

        setFieldId(field) {
            return this.formId + '-' + field;
        },

        watchSubmitStatus(value, messageSuccess, messageError) {
            if (value.code === 2) {
                this.showMask = false; // I included this inside the IFs because code can be 1 (loading or waiting)
                this.showMessageSuccess(messageSuccess);
            } else if (value.code === 3) {
                this.showMask = false;
                this.showMessageError(messageError);
            }
        }
    }
}