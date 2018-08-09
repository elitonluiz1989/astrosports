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

            this.resetFormFields();
        });
    },

    methods: {
        disableForm(disable) {
            disable = disable === undefined;

            $("#" + this.formId).find('input, select').each(function (item) {
                this.disabled = disable;
            });
        },

        resetFormFields() {},

        setFieldId(field) {
            return this.formId + '-' + field;
        },

        setFieldMessageError(field, message) {
            let element = document.getElementById(this.setFieldId(field));

            this.showMessageError(message, element);
        },

        watchSubmitStatus(value, messageSuccess, messageError) {
            if (value.code === 2) {
                this.showMask = false; // I included this inside the IFs because code can be 1 (loading or waiting)
                this.showMessageSuccess(messageSuccess);
            } else if (value.code === 3) {
                let message = value.messages.length > 0 ? value.messages : messageError;

                this.showMask = false;
                this.showMessageError(message);
            }
        }
    }
}