<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadUsersPolesStatus.code"></dashboard-request-status-message>

        <users-grant-edit-from :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></users-grant-edit-from>

        <users-delete-form type-record="grants" :record-id="recordId" :show="showDeleteModal" @hideModal="hideModal"></users-delete-form>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('pole')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Privilégio</div>
            </div>

            <div class="dashboard__schedules-list-control dashboard__schedules-list-title-item" v-if="poles.length > 0">
                <div class="dashboard__schedules-list-content"></div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-if="grants.length === 0"><div class="col-12">
                <div class="dashboard__schedules-list-content">Sem registros.</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-for="(grant, key) in grants" :key="key" v-if="loadUsersGrantsStatus.code === 2">
            <div class="dashboard__schedules-list-id">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Cod.</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="grant.id"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="grant.id"></div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list--bordered">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Polo</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="grant.name"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="grant.name"></div>
            </div>

            <div class="dashboard__schedules-list-control">
                <div class="row">
                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showEditForm(key)">
                        <i class="fa fa-lg fa-pencil"></i>
                    </button>

                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showDeleteMessage(grant.id)">
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
    import SchedulesDeleteForm from '../Delete';

    export default {
        name: "dashboard-schedules-poles-list",

        components: {
            DashboardRequestStatusMessage,
            SchedulesPoleEditFrom,
            SchedulesDeleteForm
        },

        mixins: [
            StoreRequestStatusMixin,
            DashboardSchedulesListMixin
        ],

        computed: {
            grants() {
                return this.$store.getters.getSchedulesPoles;
            },

            loadUserGrantsStatus() {
                return this.storeRequestStatus("getLoadSchedulesPolesStatus", "getSchedulesPolesMessageErrors")
            }
        },

        watch: {
            grants(value) {
                this.contentToSort = value;
            }
                   }
    }
</script>