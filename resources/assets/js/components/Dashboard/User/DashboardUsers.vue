<template>
    <div class="dashboard__users container-fluid">
        <div class="row justify-content-center" v-show="usersRequestStatus.code === 3">
            <div class="col-12 col-lg-10">
                <div class=" alert alert-danger text-center">Houve um erro e os usuários não foram carregados</div>
            </div>
        </div>

        <div class="row justify-content-center justify-content-sm-start" v-if="usersRequestStatus.code === 2">
            <div class="col-8 col-sm-4 col-lg-3 col-xl-2" v-for="(user, key) in users" :key="key">
                <dashboard-user :user-key="key"></dashboard-user>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';
    import DashboardUser from './DashboardUser';

    export default {
        name: "dashboard-users",

        components: {
          DashboardUser
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