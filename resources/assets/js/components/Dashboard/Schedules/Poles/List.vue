<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesPolesStatus.code"></dashboard-request-status-message>

        <schedules-pole-edit-from :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></schedules-pole-edit-from>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('pole')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Polo</div>
            </div>

            <div class="dashboard__schedules-list-control dashboard__schedules-list-title-item" v-if="poles.length > 0">
                <div class="dashboard__schedules-list-content"></div>
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

            <div class="dashboard__schedules-list-pole dashboard__schedules-list--bordered">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Polo</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="pole.name"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="pole.name"></div>
            </div>

            <div class="dashboard__schedules-list-control">
                <div class="row">
                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showEditForm(key)">
                        <i class="fa fa-lg fa-pencil"></i>
                    </button>

                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showDeleteMessage(pole.id)">
                        <i class="fa fa-lg fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatusMixin from '@components/Base/Mixins/StoreRequestStatus';
    import DashboardSchedulesListMixin from '@Dashboard/Mixins/DashboardSchedulesListMixin';
    import DashboardRequestStatusMessage from '@Dashboard/DashboardRequestStatusMessage';
    import SchedulesPoleEditFrom from './Edit';

    export default {
        name: "dashboard-schedules-poles-list",

        components: {
            DashboardRequestStatusMessage,
            SchedulesPoleEditFrom
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