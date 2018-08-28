<template>
    <div class="dashboard__users container-fluid">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />

        <div class="row justify-content-center justify-content-sm-around justify-content-md-start" v-if="dataLoaded">
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
    import { mapState } from 'vuex';
    import UserInfo from './User';
    import UserInsertForm from './Insert';

    export default {
        name: "users-lists",

        components: {
            UserInfo,
            UserInsertForm
        },

        mixins: [
            DashboardListMixin
        ],

        computed: {
            ...mapState({store: 'users'}),

            records() {
                return this.store.users;
            },

            pagination() {
                return this.store.pagination;
            },

            loadStatus() {
                return this.store.status.load;
            }
        }
    }
</script>
