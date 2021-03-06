<template>
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
                        <input type="reset" class="btn btn-light" value="Resetar" @click.prevent="manageFormData('reset')">

                        <input  type="submit" :class="styles.btnSubmit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import ModalMixin from '@components/Base/Mixins/ModalMixin';
    import DashboardFormEdit from '@Dashboard/Mixins/DashboardFormEditMixin';
    import DashboardSchedulesFormMixin from '@Dashboard/Mixins/DashboardSchedulesFormMixin';

    export default {
        name: "schedule-edit-form",

        mixins: [
            ModalMixin,
            DashboardFormEdit,
            DashboardSchedulesFormMixin
        ],

        data() {
            return {
                modalId: "dashboard-schedule-edit-modal",
                formId: "schedule-form-edit",
                formType: "edit", // used in mixin's methods
                reloadSchedule: false
            };
        },

        computed: {
            schedule() {
                return this.$store.getters.getSchedules[this.recordKey];
            },

            editStatus() {
                return this.storeRequestStatus("getEditScheduleStatus", "getSchedulesMessageErrors");
            },

            loadStatus() {
                return this.$store.getters.getLoadSchedulesStatus;
            }
        },

        watch: {
            editStatus(value) {
                this.watchSubmitStatus(value, "Horário atualizado com sucesso", "Houve um erro na atualização do horário.");

                if (value.code === 3) {
                    this.disableForm(false);
                }
            },

            loadStatus(value) {
                this.watchRecordLoad(value, this.editStatus.code, "o horário");
            },

            recordKey(value) {
                if (value !== null) {
                    this.manageFormData();
                }
            }
        },

        methods: {
            hideModal() {
                if (!this.showMask) {
                    this.formMessageShow = false;
                    this.disableForm(false);
                    this.$emit('hideModal');
                }
            },

            manageFormData(type) {
                for (let key in this.schedule) {
                    let defaultValue = key === "pole" || key === "category" ?
                                                this.verifyCategoryOrPole(this.schedule[key]) :
                                                this.schedule[key];

                    if (type !== "reset") {
                        this.$data[key] = defaultValue;
                    } else {
                        if(this.$data[key] !== defaultValue) {
                            this.$data[key] = defaultValue;
                        }
                    }
                }
            },

            submitForm() {
                if (this.validateScheduleForm()) {
                    let data = {};
                    let hasChange = false;

                    for (let key in this.schedule) {
                        if (key === "pole" || key === "category") {
                            if (this.$data[key] !== this.verifyCategoryOrPole(this.schedule[key])) {
                                data[key] = this.$data[key];
                                hasChange = true;
                            }
                        } else if (key !== "id" && this.$data[key] !== this.schedule[key]) {
                            data[key] = this.$data[key];
                            hasChange = true;
                        }
                    }

                    if (hasChange) {
                        data.id = this.schedule.id;
                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("editSchedule", data);
                    }
                }
            },

            verifyCategoryOrPole(data) {
                return data !== null ? data.id : 0
            }
        }
    }
</script>