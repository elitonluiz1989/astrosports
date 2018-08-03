<template>
    <div>
        <button type="button" id="polos-trigger" class="dashboard__form-trigger btn btn-success"
                data-toggle="modal" :data-target="'#' + modalId">Adicionar polo</button>

        <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark" />

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
                            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType" />

                            <div class="form-group row">
                                <label :for="setFieldId('name')" :class="styles.label">Nome</label>

                                <div class="input-group col-9">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="name">
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
    import DashboardFormInsertMixin from "@Dashboard/Mixins/DashboardFormInsertMixin";

    export default {
        name: "schedules-pole-insert-form",

        mixins: [
            DashboardFormInsertMixin,
        ],

        data() {
            return {
                formId: "schedules-poles-insert-form",
                modalId: "schedules-poles-insert-modal",
                name: ""
            }
        },

        computed: {
            addStatus() {
                return this.storeRequestStatus("getAddSchedulesPoleStatus", "getSchedulesPolesMessageErrors");
            }
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value, "Polo inserido com sucesso", "Houve um erro na inserção do polo.");
            }
        },

        methods: {
            resetFormFields() {
                this.name = "";
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome do polo");
                } else {
                    this.showMask = true;
                    this.$store.dispatch("addSchedulesPole", {name: this.name});
                }
            }
        }
    }
</script>