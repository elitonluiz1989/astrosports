<template>
    <div :id="modalId" class="modal fade" tabindex="-1" role="dialog">
        <app-mask :show-mask="showMask" mask-style="dark" />

        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header" v-if="showRequestResult">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <app-icon icon="times" />
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
                    commission: "Deseja remover este membro?",
                    "commission-role": "Deseja remover este cargo?",
                },
                messages: {
                    commission: {
                        2: "Membro removido com sucesso.",
                        3: "Não foi possível remover o membro."
                    },
                    "commission-role": {
                        2: "Cargo de comissão removida com sucesso.",
                        3: "Não foi possível remover o cargo de comissão."
                    }
                }
            }
        },

        computed: {
            deleteStatus() {
                if (this.typeRecord === "user") {
                    return this.$store.getters['commission/getStatus']('delete');
                } else if (this.typeRecord === "commission-role") {
                    return this.$store.getters['commissionRoles/getStatus']('delete');
                }
            }
        },

        methods: {
            deleteRecord() {
                this.showMask = true;

                if (this.typeRecord === "commission") {
                    this.$store.dispatch("commission/delete", this.recordId);
                } else if (this.typeRecord === "commission-role") {
                    this.$store.dispatch("commissionRoles/delete", this.recordId);
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
