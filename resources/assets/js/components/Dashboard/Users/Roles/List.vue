<template>
    <div class="dashboard-list">
        <dashboard-request-status-message :code="loadUserRolesStatus.code"
                                          :message="loadUserRolesStatus.messages" />

        <dashboard-list-row row-type="control">
            <user-role-insert-form />

            <user-role-edit-form :record-key="recordKey"
                                  :show="showEditModal"
                                  @hideModal="hideModal" />

            <user-delete-modal type-record="user-role"
                               :record-id="recordId"
                               :show="showDeleteModal"
                               @hideModal="hideModal" />
        </dashboard-list-row>

        <dashboard-list-row row-type="header">
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

        <dashboard-list-row row-type="empty" v-if="roles.length === 0" />

        <dashboard-list-row  v-for="(role, key) in roles" :key="key" v-if="loadUserRolesStatus.code === 2">
            <dashboard-list-item item-id="id"
                                 :item-title="listItems.id.title"
                                 :item-text="role.id" />

            <dashboard-list-item :item-title="listItems.role.title"
                                 :item-text="role.name"
                                 bordered />

            <dashboard-list-item item-type="control"
                                 :itemEditKey="key"
                                 :itemDeleteId="role.id" />
        </dashboard-list-row>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import UserRoleInsertForm from './Insert';
    import UserRoleEditForm from "./Edit";
    import UserDeleteModal from "../Delete";

    export default {
        name: "user-roles-list",

        components: {
            UserDeleteModal,
            UserRoleEditForm,
            UserRoleInsertForm
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
            roles() {
                return this.$store.getters.getUserRoles;
            },

            loadUserRolesStatus() {
                return this.storeRequestStatus("getLoadUserRolesStatus", "getUserRoleMessageErrors")
            }
        },

        watch: {
            roles(value) {
                this.contentToSort = value;
            }
        }
    }
</script>