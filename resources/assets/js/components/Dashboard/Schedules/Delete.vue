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
    import ModalMixin from '@components/Base/Mixins/ModalMixin';
    import AppMask from '@components/Base/AppMask';
    import StoreRequestStatus from '@components/Base/Mixins/StoreRequestStatus';

    export default {
        name: "schedules-delete-form",

        components: {
          AppMask
        },

        mixins: [
            ModalMixin,
            StoreRequestStatus
        ],

        props: {
            recordId: {
                type: Number,
                required: true
            },

            typeRecord: {
                type: String,
                default: 'schedules'
            }
        },

        data() {
            return {
                //modalId: "dashboard-schedules-delete-modal",
                showMask: false,
                showRequestResult: false,
                showRequestMessage: false,
                requestMessage: "",
                modalText: {
                    categories: "Deseja remover a categoria?",
                    poles: "Deseja remover o polo?",
                    schedules: "Deseja remover a horário?"
                },
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
            modalMessage() {
                return this.modalText[this.typeRecord];
            },

            requestStatus() {
                if (this.typeRecord === "schedules") {
                    return this.storeRequestStatus("getDeleteScheduleStatus", "getSchedulesMessageErrors")
                } else if (this.typeRecord === "poles") {
                    return this.storeRequestStatus("getDeleteSchedulesPoleStatus", "getSchedulesPolesMessageErrors")
                } else if (this.typeRecord === "categories") {
                    return this.storeRequestStatus("getDeleteSchedulesCategoryStatus", "getSchedulesCategoriesMessageErrors")
                }
            }
        },


        created() {
            this.modalId = (this.typeRecord === "schedules") ?
                "dashboard-schedule-delete-modal" :
                "dashboard-schedules-" + this.typeRecord + "-delete-modal";
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
                } else if (this.typeRecord === "poles") {
                    this.$store.dispatch("deleteSchedulesPole", this.recordId);
                } else if (this.typeRecord === "categories") {
                    this.$store.dispatch("deleteSchedulesCategory", this.recordId);
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