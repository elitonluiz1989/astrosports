<template>
    <nav class="dashboard__navbar navbar navbar-expand-md">
        <a class="navbar-brand d-md-none" href="#">Painel de controle</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-controls="dashboard-navbar-collapse" aria-expanded="false" aria-label="Dashboard navbar">
            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="dashboard-navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block">
                    <dashboard-auth-user @onUserLogout="callShowLogout"></dashboard-auth-user>
                </li>

                <li :class="setNavItemStyle(key)" v-for="(navItem, key) in navItems" :key="key">
                    <a class="nav-link" :href="navItem.link" v-text="navItem.text" v-if="navItem.active && key !== 'logout'"></a>

                    <a class="nav-link d-md-none" :href="navItem.link" v-text="navItem.text" v-if="navItem.active && key === 'logout'" @click.prevent.stop="callShowLogout"></a>

                    <span class="nav-link nav-link--disactive" v-text="navItem.text" v-if="!navItem.active"></span>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import DashboardAuthUser from './User/DashboardAuthUser';
    import { navItems } from './data/navItems';

    export default {
        name: "dashboard-navbar",

        components: {
            DashboardAuthUser
        },

        props: {
            currentPage: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                navItems: navItems
            }
        },

        methods: {
            callShowLogout() {
                this.$emit('showLogout')
            },

            setNavItemStyle(key) {
                return key === this.currentPage ? "nav-item active" : "nav-item";
            }
        }
    }
</script>