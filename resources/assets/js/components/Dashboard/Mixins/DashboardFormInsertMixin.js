import DashboardForMixin from './DashboardFormMixin';

export default {
    mixins: [
        DashboardForMixin,
    ],

    mounted() {
        $("#" + this.modalId).on('show.bs.modal', () => {
            this.formMessageShow = false;
            this.formMessageText = "";
            this.resetFormFields();
        });
    },

    methods: {
        resetFormFields() {} // this method needs be implemented in children
    }
};