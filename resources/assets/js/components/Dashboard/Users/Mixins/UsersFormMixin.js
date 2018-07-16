import { CONFIG } from '@js/config';
import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";
import UploadFile from "@components/Base/UploadFile";

export default {
    mixins: [
        DashboardFormMixin
    ],

    components: {
        UploadFile
    },

    data() {
        return {
            username: "",
            name: "",
            avatar: "",
            role: 0,
            grant: 0,
            password: "",
            confirmPassword: "",
        };
    },

    computed: {
        avatarSrc() {
            return this.avatar || CONFIG.PHOTOS.DEFAULT;
        },

        userStyles() {
            return {
                label: "col-form-label col-12 col-md-5",
                inputGroup: "input-group col-12 col-md-7",
                selectGroup: "input-group col-7 col-md-5"
            };
        },
    },

    mounted() {
        $("#" + this.formId + "-modal").on('hidden.bs.modal', () => {
            this.resetForm();
        });
    },

    methods: {
        setAvatar(avatarSrc) {
            this.avatar = avatarSrc;
        },

        resetForm() {
            this.username = "";
            this.name = "";
            this.avatar = CONFIG.PHOTOS.DEFAULT;
            this.role = 0;
            this.grant = 0;
            this.password = "";
            this.confirmPassword = "";
        },

        validateForm() {
            if (this.username === "") {
                this.setFieldMessageError("username", "Informe o nome de usuário.");
            } else if (this.role === 0) {
                this.setFieldMessageError("role", "Informe o tipo de usuário.");
            } else if (this.grant === "") {
                this.setFieldMessageError("grant", "Informe nível de privilégio do usuário.");
            } else if (this.password === "") {
                this.setFieldMessageError("password", "Informe uma senha para o usuário.");
            } else if (this.confirmPassword !== this.password) {
                this.setFieldMessageError("confirm-password", "As senhas informadas diferem.");
            } else {
                return true;
            }

            return false;
        }
    }
};