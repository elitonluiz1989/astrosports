<template>
    <ul class="list-group">
        <li class="list-group-item" v-show="usersRequestStatus === 3">Houve um erro e os usuários não foram carregados</li>
        
        <li class="list-group-item" v-for="(key, user) in users" :key="key" v-text="user.name" v-show="usersRequestStatus === 2"></li>
    </ul>
</template>

<script>
    export default {
        name: "dashboard-users",

        computed: {
            users() {
                return this.$store.getters.getUsers;
            },

            usersRequestStatus() {
                return this.$store.getters.getUsersRequestStatus;
            }
        },

        created() {
            this.$store.dispatch('loadUsers');
        }
    }
</script>

<style scoped>

</style>