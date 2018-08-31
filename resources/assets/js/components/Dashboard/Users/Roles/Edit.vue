<template>
    <div>
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

                                <div  :class="styles.inputGroup">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="fields.name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label :for="setFieldId('grant')" :class="styles.label">Permissão</label>

                                <div :class="styles.selectGroup">
                                    <select :id="setFieldId('grant')" class="form-control" v-model="fields.grant">
                                        <option value="0">...</option>
                                        <option :value="grant.id"
                                                v-for="(grant, key) in grants"
                                                v-if="grants.length > 0"
                                                :key="key">{{ grant.name | Capitalize }}</option>
                                    </select>
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
    import UserRolesMixin from "../Mixins/UserRolesMixin";

    export default {
        name: "user-role-edit-form",

        mixins: [
            DashboardModalMixin,
            DashboardFormEditMixin,
            UserRolesMixin
        ],

        data() {
            return {
                modalId: "users-role-edit-modal",
                formId: "users-role-edit-form",
                formTitle: "Editar cargo",
                formType: "edit",
                submitMessages: {
                    error: "Houve um erro na alteração do cargo.",
                    success: "Cargo alterado com sucesso"
                }
            }
        },

        computed: {

            grants() {
                return this.$store.state.userGrants.records;
            },

            record() {
                return this.$store.state.userRoles.records[this.recordKey];
            },

            editStatus() {
                return this.$store.getters['userRoles/getStatus']('edit');
            },

            loadStatus() {
                return this.$store.getters['userRoles/getStatus']('load');
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    if (this.setUpadeData()) {
                        this.formData.id = this.record.id;

                        console.log(this.formData)

                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("userRoles/edit", this.formData);
                    }
                }
            }
        }
    }
</script>
