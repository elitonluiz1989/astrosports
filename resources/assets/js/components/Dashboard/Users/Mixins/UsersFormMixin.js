import { CONFIG } from '@js/config';
import ModalMixin from "@components/Base/Mixins/ModalMixin";
import UploadFile from "@components/Base/UploadFile";
import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";

export default {
    mixins: [
        ModalMixin,
        DashboardFormMixin
    ],

    components: {
        UploadFile
    },

    data() {
        return {
            fields: {
                username: null,
                name: null,
                avatar: null,
                role: 0,
                password: null,
                "password_confirmation": null
            },
            deleteUploaded: true,
            allowPasswordUpdate: false,
            rules: {
                role: 0
            }
        };
    },

    computed: {
        avatarSrc() {
            return this.fields.avatar || CONFIG.PHOTOS.DEFAULT;
        },

        userStyles() {
            return {
                label: "col-form-label col-12 col-md-5",
                inputGroup: "input-group col-12 col-md-7",
                selectGroup: "input-group col-7 col-md-5"
            };
        },
    },

    methods: {
        validateForm() {
            if (this.isEmptyString(this.fields.username)) {
                this.setFieldMessageError("username", "Informe o nome de usuário.");
            } else if (this.fields.role === 0) {
                this.setFieldMessageError("role", "Informe o cargo de usuário.");
            } else if (this.isEmptyString(this.fields.password === "")) {
                this.setFieldMessageError("password", "Informe uma senha para o usuário.");
            } else if (this.fields.password_confirmation !== this.fields.password) {
                this.setFieldMessageError("confirm-password", "As senhas informadas diferem.");
            } else {
                return true;
            }

            return false;
        }
    }
};