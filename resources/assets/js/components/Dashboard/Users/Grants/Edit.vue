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

                                <div class="input-group col-9">
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

    export default {
        name: "user-grant-edit-form",

        mixins: [
            DashboardModalMixin,
            DashboardFormEditMixin,
        ],

        data() {
            return {
                modalId: "users-grant-edit-modal",
                formId: "users-grant-edit-form",
                formTitle: "Editar permissão",
                formType: "edit",
                fields: {
                    name: null
                },
                submitMessages: {
                    error: "Houve um erro na alteração da permissão.",
                    success: "Permissão alterada com sucesso"
                }
            }
        },

        computed: {
            grant() {
                return this.$store.state.userGrants.records[this.recordKey];
            },

            editStatus() {
                return this.$store.getters['userGrants/getStatus']('edit');
            },

            loadStatus() {
                return this.$store.getters['userGrants/getStatus']('load');
            }
        },

        watch: {
        },

        methods: {
            manageFormData(type) {
                if (type !== "reset") {
                    this.fields.name = this.grant.name;
                } else {
                    if(this.fields.name !== this.grant.name) {
                        this.fields.name = this.grant.name;
                    }
                }
            },

            submitForm() {
                if (this.isEmptyString(this.fields.name)) {
                    this.setFieldMessageError("name", "Preencha o nome da permissão.");
                } else {
                    let proceed = false,
                        data = {};

                    if (this.fields.name !== this.grant.name) {
                        data.name = this.fields.name;
                        proceed = true;
                    }

                    if (proceed) {
                        data.id = this.grant.id;
                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("userGrants/edit", data);
                    }
                }
            }
        }
    }
</script>
