<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesCategoriesStatus.code"></dashboard-request-status-message>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('category')" title="Clique para ordernar por polo">
                <div class="dashboard__schedules-list-content">Categoria</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-if="categories.length === 0">
            <div class="col-12">
                <div class="dashboard__schedules-list-content">Sem registros.</div>
            </div>
        </div>

        <div class="dashboard__schedules-list-row" v-for="(category, key) in categories" :key="key" v-if="loadSchedulesCategoriesStatus.code === 2">
            <div class="dashboard__schedules-list-id">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Cod.</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="category.id"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="category.id"></div>
            </div>

            <div class="dashboard__schedules-list-category">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Categoria</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="category.name"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="category.name"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatusMixin from '../../../Base/Mixins/StoreRequestStatus';
    import DashboardSchedulesListMixin from '../../Mixins/DashboardSchedulesListMixin';
    import DashboardRequestStatusMessage from '../../DashboardRequestStatusMessage';

    export default {
        name: "dashboard-schedules-categories-list",

        components: {
            DashboardRequestStatusMessage
        },

        mixins: [
            StoreRequestStatusMixin,
            DashboardSchedulesListMixin
        ],

        computed: {
            categories() {
                return this.$store.getters.getSchedulesCategories;
            },

            loadSchedulesCategoriesStatus() {
                return this.storeRequestStatus("getLoadSchedulesCategoriesStatus", "getSchedulesCategoriesMessageErrors")
            }
        },

        watch: {
            categories(value) {
                this.contentToSort = value;
            }
        }
    }
</script>