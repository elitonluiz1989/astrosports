<template>
    <div class="container-fluid h-100">
        <dashboard-logout :show="showLogoutModal" @onHideLogoutModal="updateShowLogoutModal"></dashboard-logout>

        <div class="row h-100">
            <div class="col-12 col-md-2 col-xl-1 col-reset h-md-100">
                <dashboard-navbar :current-page="page" @showLogout="onLogout"></dashboard-navbar>
            </div>

            <div class="col-12 col-md-10 col-xl-11 col-reset h-100">
                <div class="dashboard__title">
                    <div class="dashboard__title-text">Painel de controle</div>
                    <div class="dashboard__title-arrow"> </div>
                    <div class="dashboard__title-subtitle" v-text="currentPage"></div>
                </div>

                <div class="dashboard__content h-100"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardNavbar from './DashboardNavbar';
    import DashboardLogout from './User/DashboardLogout';

    export default {
        name: "dashboard",

        components: {
            DashboardNavbar,
            DashboardLogout
        },

        props: {
            page: {
                type: String,
                default: 'users'
            }
        },

        data() {
            return {
                showLogoutModal: false,
                tokens: []
            };
        },

        computed: {
            currentPage() {
                return this.$store.getters.getDashboardNavItems[this.page].text;
            }
        },

        mounted() {
            console.log(window.localStorage.getItem('token'))
        },

        methods: {
            onLogout() {
                this.showLogoutModal = true;
            },

            updateShowLogoutModal() {
                this.showLogoutModal = false;
            }
        }
    }
</script>