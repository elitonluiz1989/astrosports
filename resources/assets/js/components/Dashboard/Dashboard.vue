<template>
    <div class="container-fluid h-100">
        <dashboard-logout :show="showLogoutModal" @onHideLogoutModal="updateShowLogoutModal"></dashboard-logout>

        <div class="row h-100">
            <div class="col-12 col-md-2 col-xl-1 col-reset h-md-100">
                <dashboard-navbar :current-page="page" @showLogout="onLogout"></dashboard-navbar>
            </div>

            <div class="col-12 col-md-10 col-xl-11 h-100" style="background-color: white">
                <div class="dashboard__title">
                    <h1>Painel de controle</h1>
                    <span v-text="currentPage"></span>
                </div>

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