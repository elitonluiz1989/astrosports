<template>
    <nav class="dashboard__navbar navbar navbar-expand-md fixed-top">
        <a class="navbar-brand d-md-none" href="#">Painel de controle</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-controls="dashboard-navbar-collapse" aria-expanded="false" aria-label="Dashboard navbar">
            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="dashboard-navbar-collapse">
            <ul class="navbar-nav mr-auto" ref="navList">
                <li class="nav-item d-none d-md-block">
                    <auth-user @onUserLogout="callShowLogout"></auth-user>
                </li>

                <li :class="setNavItemStyle(key, navItem)" v-for="(navItem, key) in pages" :key="key">
                    <div class="nav-link-wrapper">
                        <dashboard-nav-item :id="'nav-item-' + key"
                                            :link="navItem.link"
                                            :active="isActive(navItem)"
                                            :icon="navItem.icon"
                                            :text="navItem.text"></dashboard-nav-item>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import {pages} from './data/pages';
    import AuthUser from './Users/Auth';
    import DashboardNavItem from './DashboardNavItem';

    export default {
        name: "dashboard-navbar",

        components: {
            AuthUser,
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
                pages: pages
            };
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

            isActive(item) {
                return this.isAllowed(item.userGrant) && item.active;
            },

            isAllowed(userGrant) {
                if (!this.isEmptyString(userGrant) && userGrant > 0) {
                    return this.userIsAllowed(userGrant, 'user');
                } else {
                    return true;
                }
            },

            setNavItemStyle(key, active) {
                active = active || false;

                let classes = "nav-item";
                if (key === "logout") {
                    classes += " d-md-none";
                }

                if (this.isActive(active)) {
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