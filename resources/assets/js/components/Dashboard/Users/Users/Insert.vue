<template>
    <div>
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
                                         :delete-uploaded="deleteUploaded"
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
                                         v-model="fields.avatar" />

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
                                    <input type="text" :id="setFieldId('confirm-password')" class="form-control" v-model="fields.password_confirmation">
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
    import ModalMixin from "@components/Base/Mixins/ModalMixin";

    export default {
        name: "user-insert-form",
     
        mixins: [
            UsersFormMixin,
            ModalMixin
        ],

        data() {
            return {
                formId: "user-insert-form",
                modalId: "user-insert-modal",
                formTitle: "Adicionar usuário",
                submitMessages: {
                    error: "Houve um erro ao adicionar o usuário.",
                    success: "Usuário salvo com sucesso."
                }
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
                this.watchSubmitStatus(value);

                // When save user data is successful,
                // set to doesn't remove the uploaded images
                console.log(value.code, !(value.code === 2))
                this.deleteUploaded = !(value.code === 2);
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    let data = this.setFormData();

                    this.showMask = true;
                    this.$store.dispatch("users/add", this.formData);
                }
            }
        }
    }
</script>
