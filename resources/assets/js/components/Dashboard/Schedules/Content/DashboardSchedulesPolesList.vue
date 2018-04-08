<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesPolesStatus.code"></dashboard-request-status-message>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('pole')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Polo</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-if="poles.length === 0">
            <div class="col-12">
                <div class="dashboard__schedules-list-content">Sem registros.</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-for="(pole, key) in poles" :key="key" v-if="loadSchedulesPolesStatus.code === 2">
            <div class="dashboard__schedules-list-id">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Cod.</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="pole.id"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="pole.id"></div>
            </div>

            <div class="dashboard__schedules-list-pole">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Polo</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="pole.name"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="pole.name"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatusMixin from '../../../Base/Mixins/StoreRequestStatus';
    import DashboardSchedulesListMixin from '../../Mixins/DashboardSchedulesListMixin';
    import DashboardRequestStatusMessage from '../../DashboardRequestStatusMessage';

    export default {
        name: "dashboard-schedules-poles-list",

        components: {
            DashboardRequestStatusMessage
        },

        mixins: [
            StoreRequestStatusMixin,
            DashboardSchedulesListMixin
        ],

        computed: {
            poles() {
                return this.$store.getters.getSchedulesPoles;
            },

            loadSchedulesPolesStatus() {
                return this.storeRequestStatus("getLoadSchedulesPolesStatus", "getSchedulesPolesMessageErrors")
            }
        },

        watch: {
            poles(value) {
                this.contentToSort = value;
            }
        }
    }
</script>