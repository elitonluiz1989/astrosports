<template>
    <div class="dashboard-list">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <dashboard-list-row row-type="control" v-if="statusSuccess">
            <schedule-insert-form />

            <schedule-edit-form :record-key="recordKey"
                                :show="showEditModal"
                                @hideModal="hideModal" />

            <schedule-delete-form :record-id="recordId"
                                  :show="showDeleteModal"
                                  @hideModal="hideModal" />
        </dashboard-list-row>

        <dashboard-list-row row-type="header" v-if="statusSuccess">
            <dashboard-list-item item-id="id"
                                 item-type="header"
                                 :item-title="listItems.id.message"
                                 :item-text="listItems.id.title"
                                 @click.stop="sortBy('id')" />

            <dashboard-list-item item-class="dashboard__schedules-list-hour"
                                 item-type="header"
                                 :item-title="listItems.hour.message"
                                 :item-text="listItems.hour.title"
                                 @click.stop="sortBy('hour')" />

            <dashboard-list-item item-class="dashboard__schedules-list-day"
                                 item-type="header"
                                 item-text="Dia" />

            <dashboard-list-item item-class="dashboard__schedules-list-pole"
                                 item-type="header"
                                 :item-title="listItems.pole.message"
                                 :item-text="listItems.pole.title"
                                 @click.stop="sortBy('pole')" />

            <dashboard-list-item item-class="dashboard__schedules-list-category"
                                 item-type="header"
                                 :item-title="listItems.category.message"
                                 :item-text="listItems.category.title"
                                 @click.stop="sortBy('category')" />

            <dashboard-list-item item-id="control"
                                 item-type="header" />
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasSchedules && statusSuccess" />

        <dashboard-list-row v-for="(schedule, key) in schedules" :key="key" v-if="hasSchedules && statusSuccess">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="schedule.id" />

            <dashboard-list-item item-class="dashboard__schedules-list-hour"
                                 :item-title="listItems.hour.title"
                                 :item-text="schedule.hour" />

            <dashboard-list-item item-class="dashboard__schedules-list-day"
                                 item-title="Dia"
                                 :item-text="translateDay(schedule.day)" />

            <dashboard-list-item item-class="dashboard__schedules-list-pole"
                                 :item-title="listItems.pole.title"
                                 :item-text="schedulePole(schedule)" />

            <dashboard-list-item item-class="dashboard__schedules-list-category"
                                 :item-title="listItems.category.title"
                                 :item-text="scheduleCategory(schedule)" />

            <dashboard-list-item item-type="control"
                                 :item-edit-key="key"
                                 :item-delete-id="schedule.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import { weekDays } from '@Dashboard/data/weekDays';
    import DashboardSchedulesListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import ScheduleEditForm from './Edit';
    import ScheduleDeleteForm from '../Delete';
    import ScheduleInsertForm from "./Insert";

    export default {
        name: "schedules-list",

        components: {
            ScheduleInsertForm,
            ScheduleEditForm,
            ScheduleDeleteForm
        },

        mixins: [
            DashboardSchedulesListMixin
        ],

        data() {
            return {
                listItems: {
                    id: {
                        message: "Clique para ordernar por código",
                        title: "Cod."
                    },
                    hour: {
                        message: "Clique para ordernar por horário",
                        title: "Horário"
                    },
                    pole: {
                        message: "Clique para ordernar por polo",
                        title: "Polo"
                    },
                    category: {
                        message: "Clique para ordernar por categoria",
                        title: "Categoria"
                    }
                }
            }
        },

        computed: {
            hasSchedules() {
                return this.schedules.length > 0;
            },

            schedules() {
                return this.$store.getters.getSchedules;
            },

            loadStatus() {
                return this.storeRequestStatus("getLoadSchedulesStatus", "getSchedulesMessageErrors")
            }
        },

        watch: {
            schedules(value) {
                this.contentToSort = value;
            }
        },

        methods: {
            scheduleCategory(schedule) {
                return schedule.category ? schedule.category.name : "-";
            },

            schedulePole(schedule) {
                return schedule.pole ? schedule.pole.name : "-";
            },

            translateDay(day) {
                return weekDays[day].toUpperCase();
            }
        }
    }
</script>