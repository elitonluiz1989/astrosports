<template>
    <div>
        <button type="button" id="polos-trigger" class="dashboard__form-trigger btn btn-success"
                data-toggle="modal" :data-target="'#' + modalId" v-text="formTitle"></button>

        <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form :id="formId" @submit.prevent="submitForm">
                        <div :class="styles.formHeader">
                            <h5 class="modal-title" v-text="formTitle"></h5>

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
                            <input type="reset" class="btn btn-light" :value="formResetValue">
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
        name: "users-role-insert-form",

        mixins: [
            DashboardFormMixin,
        ],

        data() {
            return {
                formId: "users-role-insert-form",
                formTitle: "Adicionar cargo",
                modalId: "users-role-insert-modal",
                name: ""
            }
        },

        computed: {
            addUsersRoleStatus() {
                return this.storeRequestStatus("getAddUsersRoleStatus", "getUsersRolesMessageErrors");
            }
        },

        watch: {
            addUsersRoleStatus(value) {
                this.watchSubmitStatus(value, "Cargo inserido com sucesso", "Houve um erro na inserção do cargo.");
            }
        },

        methods: {
            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome do cargo");
                } else {
                    this.showMask = true;
                    this.$store.dispatch("addUsersRole", {name: this.name});
                }
            }
        }
    }
</script>