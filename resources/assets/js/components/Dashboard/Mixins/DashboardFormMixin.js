import AppMask from '@components/Base/AppMask';
import FormMessage from "@components/Base/FomMessage";
import FormMessageMixin from "@components/Base/Mixins/FormMessage";
import StoreRequestStatusMixin from "@components/Base/Mixins/StoreRequestStatus";

export default {
    components: {
        FormMessage,
        AppMask
    },

    mixins: [
        FormMessageMixin,
        StoreRequestStatusMixin,
    ],

    props: {
        recordKey: {
            type: Number
        }
    },

    data() {
        return {
            formType: "insert",
            formTitle: "",
            formId: "",
            modalId: "",
            showMask: false,
            formData: {},
            fields: {},
            rules: {},
            submitMessages: {
                error: null,
                success: null
            }
        };
    },

    computed: {
        styles() {
            return {
                formHeader: {
                    "modal-header form-header--insert": this.formType === "insert",
                    "modal-header form-header--edit": this.formType === "edit",
                },
                label: "control-label col-4",
                inputGroup: "input-group col-8",
                selectGroup: "input-group col-6",
                btnTrigger: "btn btn-success w-100",
                btnSubmit: {
                    "btn btn-success": this.formType === "insert",
                    "btn btn-danger": this.formType === "edit",
                }
            };
        },

        formResetValue() {
            return this.formType === "edit" ? "Desfazer" : "Limpar";
        }
    },

    watch: {
        triggerShow(value) {
            if (value) {
                this.$refs.showFormBtn.click();
            }
        }
    },

    mounted() {
        $("#" + this.modalId).on('show.bs.modal', () => {
            this.formMessageShow = false;
            this.formMessageText = "";

            if (this.formType !== 'edit') {
                this.resetFormFields();
            }
        });
    },

    methods: {
        disableForm(disable) {
            disable = disable === undefined;

            $("#" + this.formId).find('input, select').each(function (item) {
                this.disabled = disable;
            });
        },

        setFormData() {
            for (let item in this.fields) {
                if (!this.isNullOrUndefined(this.rules[item])) {
                    if (this.fields[item] !== this.rules[item]) {
                        this.formData[item] = this.fields[item];
                    }
                } else {
                    if (!this.isEmptyString(this.fields[item])) {
                        this.formData[item] = this.fields[item];
                    }
                }
            }

            return this.formData;
        },

        resetFormFields() {
            for (let item in this.fields) {
                if (!this.isNullOrUndefined(this.rules[item])) {
                    this.fields[item] = this.rules[item];
                } else {
                    this.fields[item] = this.isNullOrUndefined(this.rules.default) ? null : this.rules.default;
                }
            }
        },

        setFieldId(field) {
            return this.formId + '-' + field;
        },

        setFieldMessageError(field, message) {
            let element = document.getElementById(this.setFieldId(field));

            this.showMessageError(message, element);
        },

        watchSubmitStatus(value, messageSuccess, messageError) {
            messageSuccess = messageSuccess || this.submitMessages.success;
            messageError = messageError || this.submitMessages.error;

            if (value.code === 2) {
                this.showMask = false; // I included this inside the IFs because code can be 1 (loading or waiting)
                this.showMessageSuccess(messageSuccess);
            } else if (value.code === 3) {
                let messages = null;

                if (!this.isEmptyArray(value.messages)) {
                    messages = value.messages;
                } else {
                    messages = messageError;
                }

                this.showMask = false;
                this.showMessageError(messages);
            }
        }
    }
};
