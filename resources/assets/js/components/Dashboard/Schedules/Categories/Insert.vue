<template>
    <div>
        <button type="button" id="categorias-trigger" :class="styles.btnTrigger"
                data-toggle="modal" :data-target="'#' + modalId">Adicionar categoria</button>

        <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form :id="formId" @submit.prevent="submitForm">
                        <div :class="styles.formHeader">
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
    import DashboardFormInsertMixin from "@Dashboard/Mixins/DashboardFormInsertMixin";

    export default {
        name: "schedules-category-insert-form",

        mixins: [
            DashboardFormInsertMixin,
        ],

        data() {
            return {
                formId: "schedules-category-insert-form",
                modalId: "schedules-category-insert-modal",
                name: ""
            }
        },

        computed: {
            editSchedulesCategoriesStatus() {
                return this.storeRequestStatus("getAddSchedulesCategoryStatus", "getSchedulesCategoriesMessageErrors");
            }
        },

        watch: {
            editSchedulesCategoriesStatus(value) {
                this.watchSubmitStatus(value, "Categoria inserido com sucesso", "Houve um erro na inserção da categoria.");
            }
        },

        methods: {
            resetFormFields() {
                this.name = "";
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome da categoria");
                } else {
                    this.showMask = true;
                    this.$store.dispatch("addSchedulesCategory", {name: this.name});
                }
            }
        }
    }
</script>