import { weekDays } from '../data/weekDays';
import AppMask from '../../Base/AppMask';
import FormMessage from "../../Base/FomMessage";
import FormMessageMixin from "../../Base/Mixins/FormMessage";
import StoreRequestStatusMixin from "../../Base/Mixins/StoreRequestStatus";
import DashboardFormMixin from "../Mixins/DashboardFormMixin";

export default {
    components: {
        FormMessage,
        AppMask
    },

    mixins: [
        FormMessageMixin,
        StoreRequestStatusMixin,
        DashboardFormMixin,
    ],

    data() {
        return {
            weekdays: weekDays,
            hour: "",
            day: 0,
            pole: 0,
            category: 0
        };
    },

    computed: {
        poles() {
            return this.$store.getters.getSchedulesPoles;
        },

        categories() {
            return this.$store.getters.getSchedulesCategories;
        }
    }
}