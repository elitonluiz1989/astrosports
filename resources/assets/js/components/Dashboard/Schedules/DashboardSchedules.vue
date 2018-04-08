<template>
    <div class="dashboard__schedules container-fluid">
        <dashboard-request-status-message :code="loadSchedulesStatus.code"></dashboard-request-status-message>

        <div class="dashboard__schedules-wrapper row row-reset justify-content-center justify-content-md-start">
            <div class="dashboard__schedules-control-title col-12 col-reset">
                Controle de horários
            </div>

            <div class="dashboard__schedules-control-item">
                <dashboard-schedules-form></dashboard-schedules-form>
            </div>

            <div class="dashboard__schedules-control-item">
                <dashboard-schedules-form-pole></dashboard-schedules-form-pole>
            </div>

            <div class="dashboard__schedules-control-item">
                <dashboard-schedules-form-category></dashboard-schedules-form-category>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <dashboard-schedules-content :active-tab="activeTab"></dashboard-schedules-content>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardRequestStatusMessage from '../DashboardRequestStatusMessage';
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';
    import DashboardSchedulesForm from './Forms/DashboardSchedulesForm';
    import DashboardSchedulesFormPole from './Forms/DashboardSchedulesFormPole';
    import DashboardSchedulesFormCategory from './Forms/DashboardSchedulesFormCategory';
    import DashboardSchedulesContent from './Content/DashboardSchedulesContent';

    export default {
        name: "dashboard-schedules",

        components: {
            DashboardRequestStatusMessage,
            DashboardSchedulesForm,
            DashboardSchedulesFormPole,
            DashboardSchedulesFormCategory,
            DashboardSchedulesContent
        },

        mixins: [
            StoreRequestStatus
        ],

        data() {
            return {
                activeTab: "horarios"
            }
        },

        computed: {
            loadSchedulesStatus() {
                return this.storeRequestStatus('getLoadSchedulesStatus', 'getSchedulesMessageErrors');
            }
        },

        created() {
            this.$store.dispatch('loadSchedules');
            this.$store.dispatch("loadSchedulesPoles");
            this.$store.dispatch("loadSchedulesCategories");

            this.setActiveTab();
        },

        methods: {
            setActiveTab() {
                let search = window.location.search;

                if (search.indexOf('mostrar') !== -1) {
                    this.activeTab = search.split("=")[1];
                }
            }
        }
    }
</script>