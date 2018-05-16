<template>
    <div>
        <button type="button"
                class="dashboard__user dashboard__user-trigger"
                data-toggle="modal"
                :data-target="'#' + formId + '-modal'">
            <i class="fa fa-plus fa-5x"></i>
        </button>

        <div :id="formId + '-modal'" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form :id="formId" @submit.prevent="submitForm">
                        <div :class="styles.formHeader">
                            <h5 class="modal-title">Adicionar usuário</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType"></form-message>

                            <div class="form-group row">
                                <label :for="setFieldId('username')" :class="userStyles.label">Nome de usuário</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('username')" class="form-control" v-model="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('name')" :class="userStyles.label">Nome</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('role')" :class="userStyles.label">Tipo de usuário</label>

                                <div class="input-group col-7">
                                    <select :id="setFieldId('role')" class="form-control" v-model="role">
                                        <option value="0">...</option>
                                        <option :value="role.id"
                                                v-for="role in userRoles" v-text="role.name"
                                                v-if="userRoles.length > 0"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('grant')" :class="userStyles.label">Privilégios</label>

                                <div class="input-group col-7">
                                    <select :id="setFieldId('grant')" class="form-control" v-model="grant">
                                        <option value="0">...</option>
                                        <option :value="grant.id"
                                                v-for="grant in userGrants"
                                                v-text="grant.name"
                                                v-if="userGrants.length > 0"></option>
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
    import UsersFormMixin from "./Mixins/UsersFormMixin";

    export default {
        name: "user-insert-form",

        mixins: [
            UsersFormMixin,
        ],

        data() {
            return {
                formId: "user-insert-form"
            }
        },

        computed: {
            addUserStatus() {
                return this.storeRequestStatus("getAddSchedulesPoleStatus", "getSchedulesPolesMessageErrors");
            },

            userRoles() {
                return [];
            },

            userGrants() {
                return [];
            }
        },

        watch: {
            addUserStatus(value) {
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