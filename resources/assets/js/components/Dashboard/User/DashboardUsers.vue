<template>
    <div class="dashboard__users container-fluid">
        <dashboard-resquest-status-message :code="usersRequestStatus.code"></dashboard-resquest-status-message>

        <div class="row justify-content-center justify-content-sm-start" v-if="usersRequestStatus.code === 2">
            <div class="dashboard__users-item" v-for="(user, key) in users" :key="key">
                <dashboard-user :user-key="key"></dashboard-user>
            </div>

            <user-insert-form class="dashboard__users-item"></user-insert-form>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';
    import DashboardResquestStatusMessage from '../DashboardRequestStatusMessage'
    import DashboardUser from './DashboardUser';
    import UserInsertForm from './Insert';

    export default {
        name: "dashboard-users",

        components: {
            UserInsertForm,
            DashboardUser,
            DashboardResquestStatusMessage
        },

        mixins: [
            StoreRequestStatus
        ],

        computed: {
            users() {
                return this.$store.getters.getUsers;
            },

            usersRequestStatus() {
                return this.storeRequestStatus('getUsersRequestStatus', 'getUsersMessageErrors')
            }
        },

        created() {
            this.$store.dispatch('loadUsers');
            this.requestMessageOnLog = true;
        }
    }
</script>