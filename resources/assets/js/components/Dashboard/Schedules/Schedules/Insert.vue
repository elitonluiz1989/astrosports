<template>
    <div>
        <button type="button" id="horarios-trigger" :class="styles.btnTrigger" data-toggle="modal"
                :data-target="'#' + modalId">Adicionar horário</button>

        <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark" />

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
                            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType" />

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
                                        <option value="none">...</option>

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
    import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";
    import DashboardSchedulesFormMixin from "@Dashboard/Mixins/DashboardSchedulesFormMixin";

    export default {
        name: "schedule-insert-form",

        mixins: [
            DashboardFormMixin,
            DashboardSchedulesFormMixin,
        ],

        data() {
            return{
                formId: "schedule-insert-form",
                modalId: "schedule-insert-modal"
            };
        },

        computed: {
            addStatus() {
                return this.storeRequestStatus("getAddScheduleStatus", "getSchedulesMessageErrors");
            }
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value, "Horário inserido com sucesso", "Houve um erro na inserção do horário.");
            }
        },

        methods: {
            resetFormFields() {
                this.hour = "";
                this.day = "none";
                this.pole = 0;
                this.category = 0;
            },

            submitForm() {
                if (this.validateScheduleForm()) {
                    this.showMask = true;

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