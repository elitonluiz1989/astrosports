<template>
    <div>
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
                            <input type="reset" class="btn btn-light" :value="formResetValue" @click.prevent="manageFormData()">

                            <input  type="submit" :class="styles.btnSubmit" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardModalMixin from '@components/Base/Mixins/ModalMixin';
    import DashboardFormEditMixin from "@Dashboard/Mixins/DashboardFormEditMixin";

    export default {
        name: "users-role-edit-form",

        mixins: [
            DashboardModalMixin,
            DashboardFormEditMixin,
        ],

        data() {
            return {
                modalId: "users-role-edit-modal",
                formId: "users-role-edit-form",
                formTitle: "Editar cargo",
                formType: "edit",
                name: ""
            }
        },

        computed: {
            role() {
                return this.$store.getters.getUserRoles[this.recordKey];
            },

            editUsersRoleStatus() {
                return this.storeRequestStatus("getEditUsersRoleStatus", "getUsersRolesMessageErrors");
            },

            loadUsersRolesStatus() {
                return this.$store.getters.getLoadUsersRolesStatus;
            }
        },

        watch: {
            editUsersRoleStatus(value) {
                this.watchSubmitStatus(value, "Cargo alterado com sucesso", "Houve um erro na alteração do cargo.");

                if (value.code === 3) {
                    this.disableForm(false);
                }
            },

            loadUsersRolesStatus(value) {
                this.watchRecordLoad(value, this.editUsersRoleStatus.code, "o cargo");
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
                    this.name = this.role.name;
                } else {
                    if(this.name !== this.role.name) {
                        this.name = this.role.name;
                    }
                }
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome do cargo");
                } else {
                    let proceed = false,
                        data = {};

                    if (this.name !== this.role.name) {
                        data.name = this.name;
                        proceed = true;
                    }

                    if (proceed) {
                        data.id = this.role.id;
                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("editUsersRole", data);
                    }
                }
            }
        }
    }
</script>