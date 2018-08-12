<template>
    <div class="dashboard-list">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <dashboard-list-row row-type="control" v-if="dataLoaded">
            <schedules-pole-insert-form />

            <schedules-pole-edit-from :record-key="recordKey"
                                      :show="showEditModal"
                                      @hideModal="hideModal" />

            <schedules-delete-form type-record="schedules-poles"
                                   :record-id="recordId"
                                   :show="showDeleteModal"
                                   @hideModal="hideModal" />
        </dashboard-list-row>

        <dashboard-list-row row-type="header" v-if="dataLoaded">
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
                                 v-if="hasRecords"/>
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasRecords && dataLoaded" />

        <dashboard-list-row  v-for="(pole, key) in records" :key="key" v-if="hasRecords && dataLoaded">
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
            records() {
                return this.$store.getters.getSchedulesPoles;
            },

            loadStatus() {
                return this.storeRequestStatus("getLoadSchedulesPolesStatus", "getSchedulesPolesMessageErrors")
            }
        },

        watch: {
            records(value) {
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