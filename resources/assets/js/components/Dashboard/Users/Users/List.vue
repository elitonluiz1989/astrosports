<template>
    <div class="dashboard__users container-fluid">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <user-edit-form :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></user-edit-form>

        <div class="row justify-content-center justify-content-sm-start" v-if="dataLoaded">
            <div class="dashboard__users-item"
                v-for="(user, key) in records"
                :key="key">
                <user-info :user-key="key"
                            @triggerShowEditForm="showEditForm"
                            @triggerShowDeleteForm="showDeleteMessage"></user-info>
            </div>

            <user-insert-form class="dashboard__users-item"></user-insert-form>
        </div>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import UserInfo from './User';
    import UserInsertForm from './Insert';
    import UserEditForm from "./Edit";

    export default {
        name: "users-lists",
        
        components: {
            UserInfo,
            UserInsertForm,
            UserEditForm
        },

        mixins: [
            DashboardListMixin
        ],

        computed: {
            records() {
                return this.$store.getters.getUsers;
            },

            pagination() {
                return this.$store.getters.getUsersPagination;
            },

            loadStatus() {
                return this.storeRequestStatus('getUsersRequestStatus', 'getUsersMessageErrors')
            }
        },
    }
</script>