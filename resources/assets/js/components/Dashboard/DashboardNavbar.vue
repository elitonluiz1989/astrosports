<template>
    <nav class="dashboard__navbar navbar navbar-expand-md">
        <a class="navbar-brand d-md-none" href="#">Painel de controle</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-controls="dashboard-navbar-collapse" aria-expanded="false" aria-label="Dashboard navbar">
            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="dashboard-navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block">
                    <dashboard-user @onUserLogout="callShowLogout"></dashboard-user>
                </li>

                <li :class="key === currentPage ? 'nav-item active' : 'nav-item'" v-for="(navItem, key) in navItems" :key="key">
                    <a class="nav-link" :href="navItem.link" v-text="navItem.text" v-show="navItem.active && key !== 'logout'"></a>

                    <a class="nav-link d-md-none" :href="navItem.link" v-text="navItem.text" v-show="navItem.active && key === 'logout'" @click.prevent.stop="callShowLogout"></a>

                    <span class="nav-link nav-link--disactive" v-text="navItem.text" v-show="!navItem.active"></span>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import DashboardUser from './User/DashboardUser';

    export default {
        name: "dashboard-navbar",

        components: {
            DashboardUser
        },

        props: {
            currentPage: {
                type: String,
                default: 'users'
            }
        },

        computed: {
            navItems() {
                return this.$store.getters.getDashboardNavItems;
            }
        },

        methods: {
            callShowLogout() {
                this.$emit('showLogout')
            }
        }
    }
</script>