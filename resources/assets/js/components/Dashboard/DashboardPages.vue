<template>
    <div class="dashboard__content">
        <keep-alive>
            <component :is="getCurrentPage"></component>
        </keep-alive>
    </div>
</template>

<script>
    import DashboardUsers from './User/DashboardUsers';
    import DashboardSchedules from './Schedules/Index';

    export default {
        name: "dashboard-pages",

        components: {
            DashboardUsers,
            DashboardSchedules
        },

        props: {
            page: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                pageList: {
                    usuarios: DashboardUsers,
                    institucional: null,
                    noticias: null,
                    fotos: null,
                    horarios: DashboardSchedules
                }
            };
        },

        computed: {
            getCurrentPage() {
                return this.pageList[this.page];
            }
        }
    }
</script>