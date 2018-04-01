<template>
    <div>
        <button type="button" class="dashboard__form-trigger btn btn-success" data-toggle="modal" :data-target="'#' + formId + '-modal'">Adicionar categoria</button>

        <div :id="formId + '-modal'" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form :id="formId" @submit.prevent="submitForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar categoria</h5>

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
    import FormMessage from "../../../Base/FomMessage";
    import FormMessageMixin from "../../../Base/Mixins/FormMessage";
    import StoreRequestStatusMixin from "../../../Base/Mixins/StoreRequestStatus";
    import DashboardScheudlesMixin from "../../Mixins/DashboardSchedulesMixin";

    export default {
        name: "dashboard-schedules-form-category",

        components: {
            FormMessage
        },

        mixins: [
            FormMessageMixin,
            StoreRequestStatusMixin,
            DashboardScheudlesMixin,
        ],

        data() {
            return {
                formName: "dashboard-schedules-category",
                name: ""
            }
        },

        computed: {
            loadSchedulesCategoriesStatus() {
                return this.storeRequestStatus("getAddSchedulesCategoryStatus", "getSchedulesPolesMessageErrors");
            }
        },

        watch: {
            loadSchedulesCategoriesStatus(value) {
                this.watchSubmitStatus(value, "Categoria inserido com sucesso", "Houve um erro na inserção da categoria.");
            }
        },

        methods: {
            submitForm() {
                if (this.name === "") {
                    let nameElement = document.getElementById(this.setFieldId("name"));
                    this.showMessageError("Preencha o nome da categoria", nameElement);
                } else {
                    this.$store.dispatch("addSchedulesCategory", {name: this.name});
                }
            }
        }
    }
</script>