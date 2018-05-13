<template>
    <div>
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
    import DashboardModalMixin from "@components/Base/Mixins/DashboardModalMixin";
    import DashboardFormEditMixin from "@Dashboard/Mixins/DashboardFormEditMixin";

    export default {
        name: "schedules-category-edit-form",

        mixins: [
            DashboardModalMixin,
            DashboardFormEditMixin
        ],

        data() {
            return {
                modalId: "schedules-category-edit-modal",
                formId: "schedules-category-edit-form",
                formType: "edit",
                name: ""
            }
        },

        computed: {
            category() {
                return this.$store.getters.getSchedulesCategories[this.recordKey];
            },

            editSchedulesCategoryStatus() {
                return this.storeRequestStatus("getEditSchedulesCategoryStatus", "getSchedulesCategoriesMessageErrors");
            },

            loadSchedulesCategoriesStatus() {
                return this.$store.getters.getLoadSchedulesCategoriesStatus;
            }
        },

        watch: {
            editSchedulesCategoryStatus(value) {
                this.watchSubmitStatus(value, "Categoria inserido com sucesso", "Houve um erro na atualização da categoria.");

                if (value.code === 3) {
                    this.disableForm(false);
                }
            },

            loadSchedulesCategoriesStatus(value) {
                this.watchRecordLoad(value, this.editSchedulesCategoryStatus.code, "a categoria");
            }
        },

        methods: {
            manageFormData(type) {
                if (type !== "reset") {
                    this.name = this.category.name;
                } else {
                    if(this.name !== this.category.name) {
                        this.name = this.category.name;
                    }
                }
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome da categoria");
                } else {
                    if (this.name !== this.category.name) {
                        let data = {
                            id: this.category.id,
                            name: this.name
                        };

                        this.showMask = true;
                        this.disableForm();
                        this.$store.dispatch("editSchedulesCategory", data);
                    }
                }
            }
        }
    }
</script>