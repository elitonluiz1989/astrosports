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

                                <div class="input-group col-9">
                                    <input type="text" :id="setFieldId('name')" class="form-control" v-model="name">
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
    import DashboardFormMixin from "@Dashboard/Mixins/DashboardFormMixin";

    export default {
        name: "user-role-insert-form",

        mixins: [
            DashboardFormMixin,
        ],

        data() {
            return {
                formId: "user-role-insert-form",
                formTitle: "Adicionar cargo",
                modalId: "user-role-insert-modal",
                name: "",
                role: 0
            }
        },

        computed: {
            addStatus() {
                return this.storeRequestStatus("getAddUserRoleStatus", "getUserRoleMessageErrors");
            }
        },

        watch: {
            addStatus(value) {
                this.watchSubmitStatus(value, "Cargo de usuário inserido com sucesso", "Houve um erro na inserção do cargo de usuário.");
            }
        },

        methods: {
            resetFormFields() {
                console.log('aa')
                this.name = "";
            },

            submitForm() {
                if (this.name === "") {
                    this.setFieldMessageError("name", "Preencha o nome do cargo de usuário");
                } else {
                    this.showMask = true;
                    this.$store.dispatch("addUserRole", {name: this.name});
                }
            }
        }
    }
</script>