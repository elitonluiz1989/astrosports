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

                    <p v-text="message" v-if="!showRequestResult"></p>
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
    import DashboardModalMixin from '../../../Base/Mixins/DashboardModalMixin';
    import AppMask from '../../../Base/AppMask';
    import StoreRequestStatus from '../../../Base/Mixins/StoreRequestStatus';

    export default {
        name: "dashboard-schedules-delete-form",

        components: {
          AppMask
        },

        mixins: [
            DashboardModalMixin,
            StoreRequestStatus
        ],

        props: {
            recordId: {
                type: Number,
                required: true
            },

            message: {
                type: String,
                required: true
            },

            typeRecord: {
                type: String,
                default: 'schedules'
            }
        },

        data() {
            return {
                modalId: "dashboard-schedules-delete-modal",
                showMask: false,
                showRequestResult: false,
                showRequestMessage: false,
                requestMessage: "",
                messages: {
                    categories: {
                        2: "Categoria removida com sucesso.",
                        3: "Não foi possível remover a categoria."
                    },
                    poles: {
                        2: "Pole removido com sucesso.",
                        3: "Não foi possível remover o pole."
                    },
                    schedules: {
                        2: "Horário removido com sucesso.",
                        3: "Não foi possível remover o horário."
                    }
                }
            }
        },

        computed: {
            requestStatus() {
                if (this.typeRecord === "schedules") {
                  return this.storeRequestStatus("getDeleteScheduleStatus", "getSchedulesMessageErrors")
                }
            }
        },

        watch: {
            requestStatus(value) {
                if (value.code > 1) {
                    this.showMask = false;
                    this.showRequestResult = true;
                    this.requestMessage = this.messages[this.typeRecord][value.code];
                }
            }
        },

        methods: {
            hideModal() {
                if (!this.showMask) {
                    this.showRequestResult = false;

                    this.$emit('hideModal');
                }
            },

            deleteRecord() {
                this.showMask = true;

                if (this.typeRecord === "schedules") {
                    this.$store.dispatch("deleteSchedule", this.recordId);
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