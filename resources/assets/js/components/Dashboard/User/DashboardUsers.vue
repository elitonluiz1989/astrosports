<template>
    <ul class="dashboard__users">
        <li class="list__item alert alert-danger text-center" v-show="usersRequestStatus.code === 3">Houve um erro e os usuários não foram carregados</li>
        
        <li class="list__item" v-for="(key, user) in users" :key="key" v-text="user.name" v-show="usersRequestStatus === 2"></li>
    </ul>
</template>

<script>
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus'

    export default {
        name: "dashboard-users",

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

<style scoped>

</style>