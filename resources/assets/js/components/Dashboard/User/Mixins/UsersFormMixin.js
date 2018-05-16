import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";

export default {
    mixins: [
        DashboardFormMixin
    ],

    data() {
        return {
            username: "",
            name: "",
            avatar: "",
            role: 0,
            grant: 0,
            password: "",
            passwordConfirm: ""
        };
    },

    computed: {
        userStyles() {
            return {
                label: "control-label col-12",
                inputGroup: "input-group col-12"
            };
        }
    }
}