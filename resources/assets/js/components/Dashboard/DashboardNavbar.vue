<template>
    <nav class="dashboard__navbar navbar navbar-expand-md">
        <a class="navbar-brand d-md-none" href="#">Painel de controle</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-controls="dashboard-navbar-collapse" aria-expanded="false" aria-label="Dashboard navbar">
            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="dashboard-navbar-collapse">
            <ul class="navbar-nav mr-auto" ref="navList">
                <li class="nav-item d-none d-md-block">
                    <dashboard-auth-user @onUserLogout="callShowLogout"></dashboard-auth-user>
                </li>

                <li :class="setNavItemStyle(key, navItem.active)" v-for="(navItem, key) in navItems" :key="key">
                    <dashboard-nav-item :id="'nav-item-' + key" :link="navItem.link" :active="navItem.active" :icon="navItem.icon" :text="navItem.text"></dashboard-nav-item>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import { navItems } from './data/navItems';
    import DashboardAuthUser from './User/DashboardAuthUser';
    import DashboardNavItem from './DashboardNavItem';

    export default {
        name: "dashboard-navbar",

        components: {
            DashboardAuthUser,
            DashboardNavItem
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

        mounted() {
            document.getElementById('nav-item-logout').addEventListener('click', evt => {
                evt.preventDefault();

                this.callShowLogout();
            });
        },

        methods: {
            callShowLogout() {
                this.$emit('showLogout')
            },

            setNavItemStyle(key, active) {
                active = active || false;

                let classes = "nav-item";
                if (key === "logout") {
                    classes += " d-md-none";
                }

                if (active) {
                    if (key === this.currentPage) {
                        classes += " active";
                    }
                } else {
                    classes += " disabled";
                }

                return classes;
            }
        }
    }
</script>