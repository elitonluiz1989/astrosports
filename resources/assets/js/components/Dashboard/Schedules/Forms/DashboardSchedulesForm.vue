<template>
    <div>
        <button type="button" class="dashboard__form-trigger btn btn-success" data-toggle="modal" :data-target="'#' + formId + '-modal'">Adicionar horário</button>

        <div :id="formId + '-modal'" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form @submit.prevent="submitForm" :id="formId">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar horário</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType"></form-message>

                            <div class="form-group row">
                                <label :for="setFieldId('hour')" :class="styles.label">Horário</label>

                                <div class="input-group col-6">
                                    <input type="time" :id="setFieldId('hour')" class="form-control" v-model="hour">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('day')" :class="styles.label">Dia da Semana</label>

                                <div :class="styles.inputGroup">
                                    <select :id="setFieldId('day')" class="form-control" v-model="day">
                                        <option value="0">...</option>

                                        <option :value="key" v-for="(day, key) in weekdays" :key="key" v-text="day.toUpperCase()"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('pole')" :class="styles.label">Polo</label>

                                <div :class="styles.inputGroup">
                                    <select :id="setFieldId('pole')" class="form-control" v-model="pole">
                                        <option value="0">...</option>

                                        <option :value="pole.id" v-for="(pole, key) in poles" :key="key" v-text="pole.name" v-if="poles.length > 0"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('category')" :class="styles.label">Categoria</label>

                                <div :class="styles.inputGroup">
                                    <select :id="setFieldId('category')" class="form-control" v-model="category">
                                        <option value="0">...</option>

                                        <option :value="category.id" v-for="(category, key) in categories" :key="key" v-text="category.name" v-if="categories.length > 0"></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="reset" class="btn btn-light" value="Limpar">
                            <input  type="submit" :class="styles.btnSubmit" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { weekDays } from '../../data/weekDays';
    import FormMessage from "../../../Base/FomMessage";
    import FormMessageMixin from "../../../Base/Mixins/FormMessage";
    import StoreRequestStatusMixin from "../../../Base/Mixins/StoreRequestStatus";
    import DashboardScheudlesFormMixin from "../../Mixins/DashboardSchedulesFormMixin";

    export default {
        name: "dashboard-schedules-form",

        components: {
            FormMessage
        },

        mixins: [
            FormMessageMixin,
            StoreRequestStatusMixin,
            DashboardScheudlesFormMixin,
        ],

        data() {
            return {
                weekdays: weekDays,
                hour: "17:45",
                day: "tue",
                pole: 1,
                category: 1
            };
        },

        computed: {
            poles() {
                return this.$store.getters.getSchedulesPoles;
            },

            categories() {
                return this.$store.getters.getSchedulesCategories;
            },

            addScheduleStatus() {
                return this.storeRequestStatus("getAddScheduleStatus", "getSchedulesMessageErrors");
            }
        },

        watch: {
            addScheduleStatus(value) {
                this.watchSubmitStatus(value, "Horário inserido com sucesso", "Houve um erro na inserção do horário.");
            }
        },

        methods: {
            submitForm() {
                if (this.hour === null) {
                    let hourElement = document.getElementById(this.setFieldId('hour'));

                    this.showMessageError("Informe uma hora", hourElement);
                } else if (this.day === 0) {
                    let dayElement = document.getElementById(this.setFieldId('day'));

                    this.showMessageError("Informe o dia da semana do horário", dayElement);
                } else if (this.pole === 0) {
                    let poleElement = document.getElementById(this.setFieldId('pole'));

                    this.showMessageError("Informe o polo do horário", poleElement);
                } else if (this.category === 0) {
                    let categoryElement = document.getElementById(this.setFieldId('category'));

                    this.showMessageError("Informe a categoria do horário", categoryElement);
                } else {
                    this.$store.dispatch("addSchedule", {
                        hour: this.hour,
                        day: this.day,
                        pole: this.pole,
                        category: this.category
                    });
                }
            }
        }
    }
</script>