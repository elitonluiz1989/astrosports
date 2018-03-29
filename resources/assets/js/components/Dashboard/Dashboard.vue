<template>
    <div class="container-fluid h-md-100">
        <dashboard-logout :show="showLogoutModal" @onHideLogoutModal="updateShowLogoutModal"></dashboard-logout>

        <div class="row h-md-100">
            <div class="dashboard__wapper-nav">
                <dashboard-navbar :current-page="currentPage" @showLogout="onLogout"></dashboard-navbar>
            </div>

            <div class="dashboard__wrapper-content">
                <div class="dashboard__title">
                    <div class="dashboard__title-text">Painel de controle</div>
                    <div class="dashboard__title-arrow"> </div>
                    <div class="dashboard__title-subtitle" v-text="currentPageText"></div>
                </div>

                <dashboard-pages :page="currentPage"></dashboard-pages>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardNavbar from './DashboardNavbar';
    import DashboardPages from './DashboardPages';
    import DashboardLogout from './User/DashboardLogout';

    import { navItems } from './data/navItems';

    export default {
        name: "dashboard",

        components: {
            DashboardNavbar,
            DashboardLogout,
            DashboardPages
        },

        props: {
            currentPage: {
                type: String,
                default: 'usuarios'
            }
        },

        data() {
            return {
                showLogoutModal: false
            };
        },

        computed: {
            currentPageText() {
                return navItems[this.currentPage] ? navItems[this.currentPage].text : this.currentPage;
            }
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