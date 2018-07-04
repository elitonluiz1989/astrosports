<template>
    <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
        <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <form :id="formId" @submit.prevent="submitForm">
                    <div :class="styles.formHeader">
                        <h5 class="modal-title">Adicionar polo</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType"></form-message>

                        <div class="form-group row">
                            <label :for="setFieldId('name')" :class="styles.label">Nome</label>

                            <div class="input-group col-9">
                                <input type="text" :id="setFieldId('name')" class="form-control" v-model="name">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="reset" class="btn btn-light" value="Desfazer" @click.prevent="manageFormData('reset')">

                        <input  type="submit" :class="styles.btnSubmit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import ModalMixin from '@components/Base/Mixins/ModalMixin';
    import DashboardFormEditMixin from "@Dashboard/Mixins/DashboardFormEditMixin";

    export default {
        name: "schedules-pole-edit-form",

        mixins: [
            ModalMixin,
            DashboardFormEditMixin,
        ],

        data() {
            return {
                modalId: "schedules-pole-edit-modal",
                formId: "schedules-pole-edit-form",
                formType: "edit",
                name: ""
            }
        },

        computed: {
            pole() {
                return this.$store.getters.getSchedulesPoles[this.recordKey];
            },

            editSchedulesPoleStatus() {
                return this.storeRequestStatus("getEditSchedulesPoleStatus", "getSchedulesPolesMessageErrors");
            },

            loadSchedulesPolesStatus() {
                return this.$store.getters.getLoadSchedulesPolesStatus;
            }
        },

        watch: {
            editSchedulesPoleStatus(value) {
                this.watchSubmitStatus(value, "Polo alterado com sucesso", "Houve um erro na alteração do polo.");

                if (value.code === 3) {
                    this.disableForm(false);
                }
            },

            loadSchedulesPolesStatus(value) {
                this.watchRecordLoad(value, this.editSchedulesPoleStatus.code, "o polo");
            },

            recordKey(value) {
                if (value !== null) {
                    this.manageFormData();
                }
            }
        },

        methods: {
            manageFormData(type) {
                if (type !== "reset") {
                    this.name = this.pole.name;
                } else {
                    if(this.name !== this.pole.name) {
                        this.name = this.pole.name;
                    }
                }
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome do polo");
                } else {
                    let procced = false,
                        data = {};

                    if (this.name !== this.pole.name) {
                        data.name = this.name;
                        procced = true;
                    }

                    if (procced) {
                        data.id = this.pole.id;
                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("editSchedulesPole", data);
                    }
                }
            }
        }
    }
</script>