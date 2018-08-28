<template>
    <div>
        <button type="button" :class="styles.btnTrigger"
                data-toggle="modal" :data-target="'#' + modalId" v-text="formTitle"></button>

        <div :id="modalId" class="dashboard__form modal fade" tabindex="-1" role="dialog">
            <app-mask :show-mask="showMask" mask-style="dark" />

            <div class="modal-dialog" role="document">
                <div class="modal-content modal-sm">
                    <form :id="formId" @submit.prevent="submitForm">
                        <div :class="styles.formHeader">
                            <h5 class="modal-title" v-text="formTitle"></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <app-icon icon="times" />
                            </button>
                        </div>

                        <div class="modal-body">
                            <form-message :show="formMessageShow" :text="formMessageText" :type="formMessageType" />

                            <div class="form-group row">
                                <label :for="setFieldId('name')" :class="styles.label">Nome</label>

                                <div :class="styles.inputGroup">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="fields.name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('grant')" :class="styles.label">Permissão</label>

                                <div :class="styles.selectGroup">
                                    <select :id="setFieldId('grant')" class="form-control" v-model="fields.grant">
                                        <option value="0">...</option>
                                        <option :value="grant.id"
                                                v-for="(grant, key) in grants" v-text="grant.name"
                                                v-if="grants.length > 0"
                                                :key="key"></option>
                                    </select>
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
    import { mapState } from 'vuex';
    import UserRolesMixin from "../Mixins/UserRolesMixin";

    export default {
        name: "user-role-insert-form",

        mixins: [
            UserRolesMixin,
        ],

        data() {
            return {
                formId: "user-role-insert-form",
                formTitle: "Adicionar cargo",
                modalId: "user-role-insert-modal",
                submitMessages: {
                    error: "Houve um erro na inserção do cargo de usuário.",
                    success: "Cargo de usuário inserido com sucesso"
                }
            }
        },

        computed: {
            addStatus() {
                return this.$store.getters['userRoles/getStatus']('add');
            },

            grants() {
                return this.$store.state.userGrants.records;
            }
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value);
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    let data = this.setFormData();

                    this.showMask = true;
                    this.$store.dispatch("userRoles/add", data);
                }
            }
        }
    }
</script>
