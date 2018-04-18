<template>
    <div>
        <button type="button" class="dashboard__form-trigger btn btn-success" data-toggle="modal"
                :data-target="'#' + formId + '-modal'"
                ref="showFormBtn"
                v-show="!hiddenShowButton">Adicionar horário</button>

        <div :id="formId + '-modal'" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form @submit.prevent="submitForm" :id="formId">
                        <div :class="styles.formHeader">
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

                                        <option :value="pole.id" v-for="(pole, key) in poles" :key="key"
                                                v-text="pole.name" v-if="poles.length > 0"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('category')" :class="styles.label">Categoria</label>

                                <div :class="styles.inputGroup">
                                    <select :id="setFieldId('category')" class="form-control" v-model="category">
                                        <option value="0">...</option>

                                        <option :value="category.id" v-for="(category, key) in categories" :key="key"
                                                v-text="category.name" v-if="categories.length > 0"></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="reset" class="btn btn-light" value="Limpar" v-if="type === 'insert'">

                            <input type="reset" class="btn btn-light" value="Resetar" v-if="type === 'edit'" @click.prevent="resetEditForm">

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
    import DashboardFormMixin from "../../Mixins/DashboardFormMixin";

    export default {
        name: "dashboard-schedules-form",

        components: {
            FormMessage
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
                day: "",
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
            },

            addScheduleStatus() {
                return this.storeRequestStatus("getAddScheduleStatus", "getSchedulesMessageErrors");
            },

            editScheduleStatus() {
                return this.storeRequestStatus("getEditScheduleStatus", "getSchedulesMessageErrors");
            }
        },

        watch: {
            addScheduleStatus(value) {
                this.watchSubmitStatus(value, "Horário inserido com sucesso", "Houve um erro na inserção do horário.");
            },

            editScheduleStatus(value) {
                this.watchSubmitStatus(value, "Horário atualizado com sucesso", "Houve um erro na atualização do horário.");
            },

            recordKey(value) {
                if (value !== null && this.type === "edit") {
                    this.record = this.$store.getters.getSchedules[this.recordKey];

                    this.hour = this.record.hour;
                    this.day = this.record.day;
                    this.pole = this.record.pole.id;
                    this.category = this.record.category.id;
                }
            }
        },

        methods: {
            resetEditForm() {
                for (let key in this.record) {
                    let defaultValue = key === "pole" || key === "category" ? this.record[key].id : this.record[key];

                    if (this.$data[key] && this.$data[key] !== defaultValue) {
                        this.$data[key] = defaultValue;
                    }
                }
            },

            submitForm() {
                if (this.type === "insert") {
                    this.submitInsertForm();
                } else if (this.type === "edit") {
                    this.submitEditForm();
                }
            },

            submitInsertForm() {
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
            },

            submitEditForm() {
                let data = {};
                let hasChange = false;

                for (let key in this.record) {
                    if (key === "pole") {
                        if (this.$data[key] !== this.record["pole"].id) {
                            data[key] = this.$data[key];
                            hasChange = true;
                        }
                    } else if (key === "category") {
                        if (this.$data[key] !== this.record["pole"].id) {
                            data[key] = this.$data[key];
                            hasChange = true;
                        }
                    } else if (key !== "id" && this.$data[key] !== this.record[key]) {
                        data[key] = this.$data[key];
                        hasChange = true;
                    }
                }

                if (hasChange) {
                    data.id = this.record.id;

                    this.$store.dispatch("editSchedule", data);
                }
            },

            triggerShowEditForm() {
                this.$refs.showFormBtn.click();
            }
        }
    }
</script>