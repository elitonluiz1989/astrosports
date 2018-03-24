<template>
    <div class="dashboard__content">
        <dashboard-users v-show="show.users"></dashboard-users>
    </div>
</template>

<script>
    import DashboardUsers from './User/DashboardUsers';

    export default {
        name: "dashboard-pages",

        components: {
            DashboardUsers
        },

        props: {
            page: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                show: {
                    users: false,
                    instutional: false,
                    news: false,
                    photos: false,
                    schedules: false
                }
            };
        },

        watch: {
            show() {
                this.setCurrentPage();
            }
        },

        mounted() {
            this.setCurrentPage();
        },

        methods: {
            setCurrentPage() {
                for (let key in this.show) {
                    if (key === this.page) {
                        this.show[key] = true;
                    } else {
                        this.show[key] = false;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>