<template>
    <div class="dashboard-list">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <dashboard-list-row row-type="control">
            <schedules-category-insert-form />

            <schedules-category-edit-form :record-key="recordKey"
                                          :show="showEditModal"
                                          @hideModal="hideModal" />

            <schedules-delete-form type-record="schedules-categories"
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
                                 :item-title="listItems.category.message"
                                 :item-text="listItems.category.title"
                                 @click.stop="sortBy('category')"  />

            <dashboard-list-item item-id="control"
                                 item-type="header"
                                 v-if="hasRecords"/>
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasRecords && dataLoaded" />

        <dashboard-list-row  v-for="(category, key) in records" :key="key" v-if="hasRecords && dataLoaded">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="category.id"
                                 @click.stop="sortBy('id')" />

            <dashboard-list-item :item-title="listItems.category.title"
                                 :item-text="category.name"
                                 @click.stop="sortBy('category')" />

            <dashboard-list-item item-type="control"
                                 :itemEditKey="key"
                                 :itemDeleteId="category.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import DashboardSchedulesListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import SchedulesCategoryEditForm from './Edit';
    import SchedulesDeleteForm from '../Delete';
    import SchedulesCategoryInsertForm from "./Insert";

    export default {
        name: "schedules-categories-list",

        components: {
            SchedulesCategoryInsertForm,
            SchedulesCategoryEditForm,
            SchedulesDeleteForm
        },

        mixins: [
            DashboardSchedulesListMixin
        ],

        computed: {
            records() {
                return this.$store.getters.getSchedulesCategories;
            },

            loadStatus() {
                return this.storeRequestStatus("getLoadSchedulesCategoriesStatus", "getSchedulesCategoriesMessageErrors")
            }
        },

        watch: {
            records(value) {
                this.contentToSort = value;
            }
        },

        created() {
            this.listItems.category = {
                message: "Clique para ordernar pela categoria",
                title: "Categoria"
            };
        }
    }
</script>
