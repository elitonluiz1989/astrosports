<template>
    <div class="dashboard__users container-fluid">
        <dashboard-resquest-status-message :code="usersRequestStatus.code"></dashboard-resquest-status-message>

        <div class="row justify-content-center justify-content-sm-start" v-if="usersRequestStatus.code === 2">
            <div class="col-8 col-sm-4 col-lg-3 col-xl-2" v-for="(user, key) in users" :key="key">
                <dashboard-user :user-key="key"></dashboard-user>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';
    import DashboardResquestStatusMessage from '../DashboardRequestStatusMessage'
    import DashboardUser from './DashboardUser';

    export default {
        name: "dashboard-users",

        components: {
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