<template>
    <div class="dashboard__schedules container-fluid">
        <dashboard-request-status-message :code="schedulesRequestStatus.code"></dashboard-request-status-message>

        <div class="row">
            <div class="col-12" v-for="(schedules, key) in schedules" v-if="schedules.length > 0">
                <div v-text="schedules"></div>
            </div>

            <div class="col-12" v-if="schedules.length === 0">
                <p class="dashboard__content--empty">Sem registros.</p>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardRequestStatusMessage from '../DashboardRequestStatusMessage';
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';

    export default {
        name: "dashboard-schedules",

        components: {
            DashboardRequestStatusMessage
        },

        mixins: [
            StoreRequestStatus
        ],

        computed: {
            schedules() {
              return this.$store.getters.getSchedules;
            },

            schedulesRequestStatus() {
                return this.storeRequestStatus('getSchedulesRequestStatus', 'getSchedulesMessageErrors');
            }
        },

        created() {
            this.$store.dispatch('loadSchedules');
            this.requestMessageOnLog = true;
        }
    }
</script>