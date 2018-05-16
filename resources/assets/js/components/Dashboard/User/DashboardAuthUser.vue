<template>
    <div class="dashboard__auth">
        <div class="dashboard__auth-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <button class="dashboard__auth-logout" @click="userLogout">Sair</button>
    </div>
</template>

<script>
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';
    import DashboardUserMixin from '../Mixins/DashboardUserMixin';

    export default {
        name: "dashboard-auth-user",

        mixins: [
            StoreRequestStatus,
            DashboardUserMixin
        ],

        computed: {
            user() {
                return this.$store.getters.getAuthUser;
            }
        },

        created() {
            this.$store.dispatch('loadAuthUser');
        },

        mounted() {
            this.storeRequestStatus('getAuthRequestStatus', 'getAuthMessageErrors');
        },

        methods: {
            userLogout() {
                this.$emit('onUserLogout');
            }
        }
    }
</script>