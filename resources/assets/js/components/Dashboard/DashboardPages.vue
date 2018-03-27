<template>
    <div class="dashboard__content">
        <keep-alive>
            <component :is="getCurrentPage"></component>
        </keep-alive>
    </div>
</template>

<script>
    import DashboardUsers from './User/DashboardUsers';
    import DasboardSchedules from './Schedules/DashboardSchedules';

    export default {
        name: "dashboard-pages",

        components: {
            DashboardUsers,
            DasboardSchedules
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
                    horarios: DasboardSchedules
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