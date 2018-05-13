<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesStatus.code"></dashboard-request-status-message>

        <schedule-edit-form :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></schedule-edit-form>

        <schedule-delete-form :record-id="recordId" :show="showDeleteModal" @hideModal="hideModal"></schedule-delete-form>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item"
                 @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-hour dashboard__schedules-list-title-item"
                 @click.stop="sortBy('hour')" title="Clique para ordernar por horário">
                <div class="dashboard__schedules-list-content">Horário</div>
            </div>

            <div class="dashboard__schedules-list-day dashboard__schedules-list-title-item">
                <div class="dashboard__schedules-list-content">Dia</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item"
                 @click.stop="sortBy('pole')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Polo</div>
            </div>

            <div class="dashboard__schedules-list-category dashboard__schedules-list-title-item"
                 @click.stop="sortBy('category')" title="Clique para ordernar por categoria">
                <div class="dashboard__schedules-list-content">Categoria</div>
            </div>

            <div class="dashboard__schedules-list-control dashboard__schedules-list-title-item" v-if="schedules.length > 0">
                <div class="dashboard__schedules-list-content"></div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-if="schedules.length === 0">
            <div class="col-12 col-reset">
                <div class="dashboard__schedules-list--empty">Sem registros.</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-for="(schedule, key) in schedules" :key="key" v-if="loadSchedulesStatus.code === 2 && schedules.length > 0">
            <div class="dashboard__schedules-list-id">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Cod.</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="schedule.id"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="schedule.id"></div>
            </div>
            <div class="dashboard__schedules-list-hour">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Horário</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="schedule.hour"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="schedule.hour"></div>
            </div>
            <div class="dashboard__schedules-list-day">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Dia da semana</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="translateDay(schedule.day)"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="translateDay(schedule.day)"></div>
            </div>
            <div class="dashboard__schedules-list-pole">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Polo</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="schedulePole(schedule)"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="schedulePole(schedule)"></div>
            </div>
            <div class="dashboard__schedules-list-category dashboard__schedules-list--bordered">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Categoria</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="scheduleCategory(schedule)"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="scheduleCategory(schedule)"></div>
            </div>

            <div class="dashboard__schedules-list-control">
                <div class="row">
                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showEditForm(key)">
                        <i class="fa fa-lg fa-pencil"></i>
                    </button>

                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showDeleteMessage(schedule.id)">
                        <i class="fa fa-lg fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { weekDays } from '@Dashboard/data/weekDays';
    import StoreRequestStatusMixin from '@components/Base/Mixins/StoreRequestStatus';
    import DashboardSchedulesListMixin from '@Dashboard/Mixins/DashboardSchedulesListMixin';
    import DashboardRequestStatusMessage from '@Dashboard/DashboardRequestStatusMessage';
    import ScheduleEditForm from './Edit';
    import ScheduleDeleteForm from '../Delete';

    export default {
        name: "schedules-list",

        components: {
            DashboardRequestStatusMessage,
            ScheduleEditForm,
            ScheduleDeleteForm
        },

        mixins: [
            StoreRequestStatusMixin,
            DashboardSchedulesListMixin
        ],

        computed: {
            schedules() {
                return this.$store.getters.getSchedules;
            },

            loadSchedulesStatus() {
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