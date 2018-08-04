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
                name: ""
            }
        },

        computed: {
            grant() {
                return this.$store.getters.getUserGrants[this.recordKey];
            },

            editStatus() {
                return this.storeRequestStatus("getEditUserGrantStatus", "getUserGrantMessageErrors");
            },

            loadStatus() {
                return this.$store.getters.getLoadUserGrantsStatus;
            }
        },

        watch: {
            editStatus(value) {
                this.watchSubmitStatus(value, "Permissão alterada com sucesso", "Houve um erro na alteração da permissão.");

                if (value.code === 3) {
                    this.disableForm(false);
                }
            },

            loadStatus(value) {
                this.watchRecordLoad(value, this.editStatus.code, "a permissão");
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
                    this.name = this.grant.name;
                } else {
                    if(this.name !== this.grant.name) {
                        this.name = this.grant.name;
                    }
                }
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome da permissão.");
                } else {
                    let proceed = false,
                        data = {};

                    if (this.name !== this.grant.name) {
                        data.name = this.name;
                        proceed = true;
                    }

                    if (proceed) {
                        data.id = this.grant.id;
                        this.showMask = true;
                        this.formMessageShow = false;

                        this.disableForm();

                        this.$store.dispatch("editUserGrant", data);
                    }
                }
            }
        }
    }
</script>