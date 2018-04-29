<template>
    <div :id="modalId" class="modal fade" tabindex="-1" role="dialog">
        <app-mask :show-mask="showMask" mask-style="dark"></app-mask>

        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-body">
                    <p v-text="message"></p>
                </div>
                <div class="modal-footer">
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

    export default {
        name: "dashboard-schedules-delete-form",

        components: {
          AppMask
        },

        mixins: [
            DashboardModalMixin
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
                showMask: false
            }
        },

        methods: {
            hideModal() {
                if (!this.showMask) {
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

<style scoped>
    .mask {
        z-index: 99999;
    }

    .modal-content,
    .modal-body {
        background-color: #333;
        color: white;
    }

    .modal-footer {
        border-top-color: #444;
    }
</style>