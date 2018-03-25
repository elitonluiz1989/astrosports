<template>
    <div class="dashboard__content">
        <dashboard-users v-show="show.usuarios"></dashboard-users>
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
                    usuarios: false,
                    institucional: false,
                    noticias: false,
                    fotos: false,
                    horarios: false
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