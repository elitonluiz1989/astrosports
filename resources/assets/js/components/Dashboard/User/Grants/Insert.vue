<template>
    <div>
        <button type="button" id="polos-trigger" class="dashboard__form-trigger btn btn-success"
                data-toggle="modal" :data-target="'#' + formId + '-modal'">Adicionar polo</button>

        <div :id="formId + '-modal'" class="dashboard__form modal fade" tabindex="-1" role="dialog">
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

    export default {
        name: "schedules-pole-insert-form",

        mixins: [
            DashboardFormMixin,
        ],

        data() {
            return {
                formId: "schedules-poles-insert-form",
                name: ""
            }
        },

        computed: {
            addSchedulesPoleStatus() {
                return this.storeRequestStatus("getAddSchedulesPoleStatus", "getSchedulesPolesMessageErrors");
            }
        },

        watch: {
            addSchedulesPoleStatus(value) {
                this.watchSubmitStatus(value, "Polo inserido com sucesso", "Houve um erro na inserção do polo.");
            }
        },

        methods: {
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