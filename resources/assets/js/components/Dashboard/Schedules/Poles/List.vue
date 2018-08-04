<template>
    <div class="dashboard-list">
        <dashboard-request-status-message :code="loadStatus.code"
                                           :message="loadStatus.messages" />

        <dashboard-list-row row-type="control">
            <schedules-pole-insert-form />

            <schedules-pole-edit-from :record-key="recordKey"
                                      :show="showEditModal"
                                      @hideModal="hideModal" />

            <schedules-delete-form type-record="schedules-poles"
                                   :record-id="recordId"
                                   :show="showDeleteModal"
                                   @hideModal="hideModal" />
        </dashboard-list-row>

        <dashboard-list-row row-type="header">
            <dashboard-list-item item-id="id"
                                 item-type="header"
                                 :item-title="listItems.id.message"
                                 :item-text="listItems.id.title"
                                 @click.stop="sortBy('id')" />

            <dashboard-list-item item-type="header"
                                 :item-title="listItems.pole.message"
                                 :item-text="listItems.pole.title"
                                 @click.stop="sortBy('pole')"  />

            <dashboard-list-item item-id="control"
                                 item-type="header"
                                 v-if="hasPoles"/>
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasPoles" />

        <dashboard-list-row  v-for="(pole, key) in poles" :key="key" v-if="loadStatus.code === 2">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="pole.id" />

            <dashboard-list-item :item-title="listItems.pole.title"
                                 :item-text="pole.name" />

            <dashboard-list-item item-type="control"
                                 :itemEditKey="key"
                                 :itemDeleteId="pole.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import DashboardSchedulesListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import SchedulesPoleEditFrom from './Edit';
    import SchedulesDeleteForm from '../Delete';
    import SchedulesPoleInsertForm from "./Insert";

    export default {
        name: "dashboard-schedules-poles-list",

        components: {
            SchedulesPoleInsertForm,
            SchedulesPoleEditFrom,
            SchedulesDeleteForm
        },

        mixins: [
            DashboardSchedulesListMixin
        ],

        computed: {
            hasPoles() {
                return this.poles.length > 0;
            },

            poles() {
                return this.$store.getters.getSchedulesPoles;
            },

            loadStatus() {
                return this.storeRequestStatus("getLoadSchedulesPolesStatus", "getSchedulesPolesMessageErrors")
            }
        },

        watch: {
            poles(value) {
                this.contentToSort = value;
            }
        },

        created() {
            this.listItems.pole = {
                message: "Clique para ordernar pelo polo",
                title: "Polo"
            };
        }
    }
</script>