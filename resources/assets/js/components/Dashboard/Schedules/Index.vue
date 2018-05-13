<template>
    <div class="dashboard__schedules container-fluid">
        <dashboard-request-status-message :code="loadSchedulesStatus.code"></dashboard-request-status-message>

        <div class="dashboard__schedules-wrapper row row-reset justify-content-center justify-content-md-start">
            <div class="dashboard__schedules-control-title col-12 col-reset">
                Controle de horários
            </div>

            <div class="dashboard__schedules-control-item">
                <schedules-insert-form></schedules-insert-form>
            </div>

            <div class="dashboard__schedules-control-item">
                <schedules-poles-insert-form></schedules-poles-insert-form>
            </div>

            <div class="dashboard__schedules-control-item">
                <schedules-category-insert-form></schedules-category-insert-form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <schedules-lists :active-tab="activeTab"></schedules-lists>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardRequestStatusMessage from '../DashboardRequestStatusMessage';
    import StoreRequestStatus from '@components/Base/Mixins/StoreRequestStatus';
    import SchedulesInsertForm from './Schedules/Insert';
    import SchedulesPolesInsertForm from './Poles/Insert';
    import SchedulesCategoryInsertForm from './Categories/Insert';
    import SchedulesLists from './Lists';

    export default {
        name: "dashboard-schedules",

        components: {
            DashboardRequestStatusMessage,
            SchedulesInsertForm,
            SchedulesPolesInsertForm,
            SchedulesCategoryInsertForm,
            SchedulesLists
        },

        mixins: [
            StoreRequestStatus
        ],

        data() {
            return {
                activeTab: "horarios",
                recordKey: {
                    schedules: null,
                    poles: null,
                    categories: null
                }
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

        mounted() {
            $(".dashboard__form-trigger").on("click", evt => {
                let targetTab = evt.target.id.replace("-trigger", "");

                if(targetTab !== "") {
                    this.activeTab = targetTab;
                }
            });
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