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
    import CommissionRolesMixin from "../Mixins/CommissionRolesMixin";

    export default {
        name: "commission-role-insert-form",

        mixins: [
            CommissionRolesMixin,
        ],

        data() {
            return {
                formId: "commission-role-insert-form",
                formTitle: "Adicionar cargo",
                modalId: "commission-role-insert-modal",
                submitMessages: {
                    error: "Houve um erro na inserção do cargo.",
                    success: "Cargo inserido com sucesso"
                }
            }
        },

        computed: {
            addStatus() {
                return this.$store.getters['commissionRoles/getStatus']('add');
            },
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value);
            }
        },

        methods: {
            submitForm() {
                if (this.validateForm()) {
                    this.setFormData();

                    this.showMask = true;
                    this.$store.dispatch("commissionRoles/add", this.formData);
                }
            }
        }
    }
</script>
