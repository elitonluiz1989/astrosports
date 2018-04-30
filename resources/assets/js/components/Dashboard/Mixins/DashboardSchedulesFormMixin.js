import { weekDays } from '../data/weekDays';
import DashboardFormMixin from './DashboardFormMixin';

export default {
    mixins: [
        DashboardFormMixin,
    ],

    data() {
        return {
            weekdays: weekDays,
            hour: "",
            day: "none",
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
    },

    methods: {
        validateScheduleForm() {
            let validated = false;

            if (this.hour === "") {
                this.setFieldMessageError("hour", "Informe uma hora");
            } else if (this.day === "none") {
                this.setFieldMessageError("day", "Informe o dia da semana do horário");
            } else if (this.pole === 0) {
                this.setFieldMessageError("pole", "Informe o polo do horário");
            } else if (this.category === 0) {
                this.setFieldMessageError("category", "Informe a categoria do horário");
            } else {
                validated = true;
            }

            return validated;
        }
    }
}