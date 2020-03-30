import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";

export default {
    mixins: [
        DashboardFormMixin
    ],

    data() {
        return {
            fields: {
                name: null,
                grant: 0
            },

            rules: {
                grant: 0
            }
        };
    },

    methods: {
        validateForm() {
            if (this.isEmptyString(this.fields.name)) {
                this.setFieldMessageError("name", "Preencha o nome do cargo");
                return false;
            } else {
                 return true;
             }
        }
    }
};
