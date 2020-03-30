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
    import CommissionRolesMixin from "../Mixins/CommissionRolesMixin";

    export default {
        name: "commission-role-edit-form",

        mixins: [
            DashboardModalMixin,
            DashboardFormEditMixin,
            CommissionRolesMixin
        ],

        data() {
            return {
                modalId: "commission-role-edit-modal",
                formId: "commission-role-edit-form",
                formTitle: "Editar cargo",
                formType: "edit",
                submitMessages: {
                    error: "Houve um erro na alteração do cargo.",
                    success: "Cargo alterado com sucesso."
                }
            }
        },

        computed: {
            record() {
                return this.$store.state.commissionRoles.records[this.recordKey];
            },

            editStatus() {
                return this.$store.getters['commissionRoles/getStatus']('edit');
            },

            loadStatus() {
                return this.$store.getters['commissionRoles/getStatus']('load');
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    if (this.setUpdateData()) {
                        this.formData.id = this.record.id;

                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("commissionRoles/edit", this.formData);
                    }
                }
            }
        }
    }
</script>
