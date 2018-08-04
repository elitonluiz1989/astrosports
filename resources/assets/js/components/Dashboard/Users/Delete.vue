<template>
    <div :id="modalId" class="modal fade" tabindex="-1" role="dialog">
        <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header" v-if="showRequestResult">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="text-center" v-text="requestMessage" v-if="showRequestResult"></p>

                    <p v-text="modalMessage" v-if="!showRequestResult"></p>
                </div>

                <div class="modal-footer" v-if="!showRequestResult">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Não</button>
                    <button type="button"  class="btn btn-danger" @click.stop="deleteRecord">Sim</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardDeleteMessageMixin from "@Dashboard/Mixins/DashboardDeleteMessageMixin";

    export default {
        name: "user-delete-modal",

        mixins: [
            DashboardDeleteMessageMixin
        ],

        data() {
            return {
                modalText: {
                    user: "Deseja remover o usuário?",
                    "user-role": "Deseja remover o tipo função de usuário?",
                    "user-grant": "Deseja remover o tipo privilégio de usuário?"
                },
                messages: {
                    user: {
                        2: "Usuário removido com sucesso.",
                        3: "Não foi possível remover o usuário."
                    },
                    "user-role": {
                        2: "Tipo função de usuário removida com sucesso.",
                        3: "Não foi possível remover o tipo função de usuário."
                    },
                    "user-grant": {
                        2: "Tipo privilégio de usuário removido com sucesso.",
                        3: "Não foi possível remover o tipo privilégio de usuário."
                    }
                }
            }
        },

        computed: {
            requestStatus() {
                if (this.typeRecord === "user") {
                } else if (this.typeRecord === "user-role") {
                } else if (this.typeRecord === "user-grant") {
                    return this.storeRequestStatus("getDeleteUserGrantStatus", "getUserGrantMessageErrors")
                }
            }
        },

        methods: {
            deleteRecord() {
                this.showMask = true;

                if (this.typeRecord === "user") {
                } else if (this.typeRecord === "user-role") {
                } else if (this.typeRecord === "user-grant") {
                    this.$store.dispatch("deleteUserGrant", this.recordId);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .mask {
        z-index: 99999;
    }

    .modal-content,
    .modal-body {
        background-color: #333;
        color: white;
    }

    .modal-header {
        border-bottom: 0;
        padding-top: 0;
        padding-right: 0.3rem;
        padding-bottom: 0;

        .close {
            font-size: 1.2rem;
        }
    }

    .modal-footer {
        border-top-color: #444;
    }
</style>