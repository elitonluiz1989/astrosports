<template>
    <div>
        <button type="button"
                class="dashboard__user dashboard__user-trigger"
                data-toggle="modal"
                :data-target="'#' + modalId">
            <i class="fa fa-plus fa-5x"></i>
        </button>

        <div :id="modalId" class="dashboard__users-insert modal fade" tabindex="-1" role="dialog">
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

                            <upload-file :class="'form-group row'"
                                         delete-url="/storage/images/delete"
                                         :modal-id="modalId"
                                         formats="image/*"
                                         :limit="1"
                                         :list-uploaded="false"
                                         message-default="Click or arraste para enviar a imagem."
                                         message-error="Ocorreu um erro no envio da imagem. Tente novamente."
                                         message-limit="Foi enviado o limite de imagens."
                                         :show-progress="true"
                                         server-file-name="images"
                                         url="/storage/images/upload"
                                         v-model="fields.avatar">
                            </upload-file>

                            <div class="form-group row">
                                <div class="dashboard__user-avatar">
                                    <img :src="avatarSrc" class="img">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('username')" :class="userStyles.label">Nome de usuário</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('username')" class="form-control" v-model="fields.username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('name')" :class="userStyles.label">Nome</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="fields.name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('role')" :class="userStyles.label">Tipo de usuário</label>

                                <div :class="userStyles.selectGroup">
                                    <select :id="setFieldId('role')" class="form-control" v-model="fields.role">
                                        <option value="0">...</option>
                                        <option :value="role.id"
                                                v-for="(role, key) in roles" v-text="role.name"
                                                v-if="roles.length > 0"
                                                :key="key"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('passowrd')" :class="userStyles.label">Senha</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('password')" class="form-control" v-model="fields.password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('confirm-password')" :class="userStyles.label">Confirme a senha</label>

                                <div :class="userStyles.inputGroup">
                                    <input type="text" :id="setFieldId('confirm-password')" class="form-control" v-model="fields.confirmPassword">
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
    import UsersFormMixin from "../Mixins/UsersFormMixin";

    export default {
        name: "user-insert-form",

        mixins: [
            UsersFormMixin,
        ],

        data() {
            return {
                formId: "user-insert-form",
                modalId: "user-insert-modal"
            }
        },

        computed: {
            addStatus() {
                return this.$store.getters["users/getStatus"]("add");
            },

            roles() {
                return this.$store.state.userRoles.records;
            }
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value, "Usuário inserido com sucesso", "Houve um erro na inserção do usuário.");
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    let data = this.setFormData();

                    console.log(data)

                    //this.showMask = true;
                    //this.$store.dispatch("addSchedulesPole", {name: this.name});
                }
            }
        }
    }
</script>
