<template>
    <div class="dashboard-list">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <dashboard-list-row row-type="control">
            <commission-role-insert-form />

            <commission-role-edit-form :record-key="recordKey"
                                  :show="showEditModal"
                                  @hideModal="hideModal" />

            <commission-delete-modal type-record="commission-role"
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
                                 :item-title="listItems.role.message"
                                 :item-text="listItems.role.title" />

            <dashboard-list-item item-id="control"
                                 item-type="header" />
        </dashboard-list-row>

        <dashboard-list-row row-type="empty" v-if="!hasRecords && dataLoaded" />

        <dashboard-list-row  v-for="(role, key) in records" :key="key" v-if="hasRecords && dataLoaded">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="role.id" />

            <dashboard-list-item :item-title="listItems.role.title"
                                 :item-text="role.name" />

            <dashboard-list-item item-type="control"
                                 :itemEditKey="key"
                                 :itemDeleteId="role.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import CommissionRoleInsertForm from './Insert';
    import CommissionRoleEditForm from "./Edit";
    import CommissionDeleteModal from "../Delete";

    export default {
        name: "commission-roles-list",

        components: {
            CommissionDeleteModal,
            CommissionRoleEditForm,
            CommissionRoleInsertForm
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
                    role: {
                        title: "Cargo",
                        message: "Clique para ordernar pelo cargo"
                    }
                }
            };
        },

        computed: {
            ...mapState({store: 'commissionRoles'}),

            records() {
                return this.store.records;
            },

            loadStatus() {
                return this.store.status.load;
            }
        },

        watch: {
            records(value) {
                this.contentToSort = value;
            }
        }
    }
</script>
