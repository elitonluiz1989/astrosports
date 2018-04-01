<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesStatus.code"></dashboard-request-status-message>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>
            <div class="dashboard__schedules-list-hour dashboard__schedules-list-title-item" @click.stop="sortBy('hour')" title="Clique para ordernar por horário">
                <div class="dashboard__schedules-list-content">Horário</div>
            </div>
            <div class="dashboard__schedules-list-day dashboard__schedules-list-title-item">
                <div class="dashboard__schedules-list-content">Dia</div>
            </div>
            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('pole')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Polo</div>
            </div>
            <div class="dashboard__schedules-list-category dashboard__schedules-list-title-item" @click.stop="sortBy('category')" title="Clique para ordernar por categoria">
                <div class="dashboard__schedules-list-content">Categoria</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" :key="key" v-if="schedules.length === 0">
            <div class="col-12">
                <div class="dashboard__schedules-list-content">Sem registros.</div>
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
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Pole</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="schedule.pole"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="schedule.pole"></div>
            </div>
            <div class="dashboard__schedules-list-category">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Categoria</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="schedule.category"></div>
                </div>
                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="schedule.category"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import { weekDays } from '../../data/weekDays';
    import StoreRequestStatusMixin from '../../../Base/Mixins/StoreRequestStatus';
    import DashboardRequestStatusMessage from '../../DashboardRequestStatusMessage'

    export default {
        name: "dashboard-schedules-list",

        components: {
            DashboardRequestStatusMessage
        },

        mixins: [
            StoreRequestStatusMixin
        ],

        data() {
            return {
                sortByDesc: false
            };
        },

        computed: {
            schedules() {
                return this.$store.getters.getSchedules;
            },

            loadSchedulesStatus() {
                return this.storeRequestStatus("getLoadSchedulesStatus", "getSchedulesMessageErrors")
            }
        },

        methods: {
            sortBy(key) {
                this.schedules.sort((item1, item2) => {
                    const val1 = typeof item1[key] === "string" ? item1[key].toUpperCase() : item1[key];
                    const val2 = typeof item2[key] === "string" ? item2[key].toUpperCase() : item2[key];

                    let comparison = 0;

                    if (val1 > val2) {
                        comparison = 1;
                    } else {
                        comparison = -1;
                    }

                    return this.sortByDesc ? (comparison * - 1) : comparison;
                });

                this.sortByDesc = !this.sortByDesc;
            },

            translateDay(day) {
                return weekDays[day].toUpperCase();
            }
        }
    }
</script>