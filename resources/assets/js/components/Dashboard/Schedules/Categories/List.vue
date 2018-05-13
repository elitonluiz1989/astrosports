<template>
    <div class="dashboard__schedules-list">
        <dashboard-request-status-message :code="loadSchedulesCategoriesStatus.code"></dashboard-request-status-message>

        <schedules-category-edit-form :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></schedules-category-edit-form>

        <schedules-delete-form type-record="categories" :record-id="recordId" :show="showDeleteModal" @hideModal="hideModal"></schedules-delete-form>

        <div class="dashboard__schedules-list-title d-none d-sm-flex">
            <div class="dashboard__schedules-list-id dashboard__schedules-list-title-item" @click.stop="sortBy('id')" title="Clique para ordernar por código">
                <div class="dashboard__schedules-list-content">Cod.</div>
            </div>

            <div class="dashboard__schedules-list-pole dashboard__schedules-list-title-item" @click.stop="sortBy('category')" title="Clique para ordernar por categoria">
                <div class="dashboard__schedules-list-content">Categoria</div>
            </div>


            <div class="dashboard__schedules-list-control dashboard__schedules-list-title-item" v-if="categories.length > 0">
                <div class="dashboard__schedules-list-content"></div>
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

            <div class="dashboard__schedules-list-category dashboard__schedules-list--bordered">
                <div class="row d-sm-none">
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--title col-6 col-reset">Categoria</div>
                    <div class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset" v-text="category.name"></div>
                </div>

                <div class="dashboard__schedules-list-content d-none d-sm-block" v-text="category.name"></div>
            </div>

            <div class="dashboard__schedules-list-control">
                <div class="row">
                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showEditForm(key)">
                        <i class="fa fa-lg fa-pencil"></i>
                    </button>

                    <button class="dashboard__schedules-list-content dashboard__schedules-list-content--text col-6 col-reset"
                            @click.stop="showDeleteMessage(category.id)">
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
    import SchedulesCategoryEditForm from './Edit';
    import SchedulesDeleteForm from '../Delete';

    export default {
        name: "schedules-categories-list",

        components: {
            DashboardRequestStatusMessage,
            SchedulesCategoryEditForm,
            SchedulesDeleteForm
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