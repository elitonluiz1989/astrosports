<template>
    <div class="dashboard__user">
        <div class="dashboard__user-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <div class="dashboard__user-item" v-text="user.name"></div>

        <div class="dashboard__user-item" v-text="role"></div>
    </div>
</template>

<script>
    import DashboardUser from '../Mixins/DashboardUserMixin';

    export default {
        name: "dashboard-user",

        mixins: [
          DashboardUser
        ],

        props: {
            userKey: {
                type: Number,
                required: true,
            }
        },

        computed: {
            user() {
                return this.$store.getters.getUsers[this.userKey];
            },

            role() {
                return this.user.role.charAt(0).toUpperCase() + this.user.role.slice(1);
            }
        }
    }
</script>

<style scoped>

</style>