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
                name: null,
                avatar: null,
                role: 0,
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

        commissionStyles() {
            return {
                label: "col-form-label col-12 col-md-5",
                inputGroup: "input-group col-12 col-md-7",
                selectGroup: "input-group col-7 col-md-5"
            };
        },
    },

    methods: {
        validateForm() {
            if (this.isEmptyString(this.fields.name)) {
                this.setFieldMessageError("name", "Informe o nome de usuário.");
            } else if (this.fields.role === 0) {
                this.setFieldMessageError("role", "Informe o cargo de usuário.");
            } else {
                return true;
            }

            return false;
        }
    }
};