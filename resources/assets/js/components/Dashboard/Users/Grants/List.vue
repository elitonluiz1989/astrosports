<template>
    <div class="dashboard-list">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <dashboard-list-row row-type="control" v-if="dataLoaded">
            <user-grant-insert-form />

            <user-grant-edit-form :record-key="recordKey"
                                  :show="showEditModal"
                                  @hideModal="hideModal" />

            <user-delete-modal type-record="user-grant"
                               :record-id="recordId"
                               :show="showDeleteModal"
                               @hideModal="hideModal" />
        </dashboard-list-row>

        <dashboard-list-row row-type="header" v-if="dataLoaded">
            <dashboard-list-item item-id="id"
                                 item-type="header"
                                 :item-title="listItems.id.message"
                                 :item-text="listItems.id.title" />

            <dashboard-list-item item-type="header"
                                 :item-title="listItems.grant.message"
                                 :item-text="listItems.grant.title" />

            <dashboard-list-item item-id="control"
                                 item-type="header" />
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasRecords && dataLoaded" />

        <dashboard-list-row  v-for="(grant, key) in records" :key="key" v-if="hasRecords && dataLoaded">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="grant.id" />

            <dashboard-list-item :item-title="listItems.grant.title"
                                 :item-text="grant.name"
                                 bordered />

            <dashboard-list-item item-type="control"
                                 :itemEditKey="key"
                                 :itemDeleteId="grant.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import UserGrantInsertForm from './Insert';
    import UserGrantEditForm from "./Edit";
    import UserDeleteModal from "../Delete";

    export default {
        name: "user-grants-list",

        components: {
            UserDeleteModal,
            UserGrantEditForm,
            UserGrantInsertForm
        },

        mixins: [
            DashboardListMixin
        ],

        data() {
            return {
                listItems: {
                    id: {
                        title: "Cod.",
                        message: "Clique para ordernar por código"
                    },
                    grant: {
                        title: "Permissão",
                        message: "Clique para ordernar pela permissão"
                    }
                }
            };
        },

        computed: {
            records() {
                return this.$store.getters.getUserGrants;
            },

            loadStatus() {
                return this.storeRequestStatus("getLoadUserGrantsStatus", "getUserGrantMessageErrors")
            },
        },

        watch: {
            records(value) {
                this.contentToSort = value;
            }
        }
    }
</script>