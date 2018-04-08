<template>
    <div class="dashboard__schedules-tabs">
        <ul class="nav nav-tabs" id="dashboard-schedules-content-tabs" role="tablist">
            <li class="nav-item" v-for="(item, key) in items" :key="key">
                <a :class="navLinkStyle(key)" :id="setTabId(key)" data-toggle="tab" :href="'#' + key" role="tab" :aria-controls="key" aria-selected="true" v-text="item" @click="changeUrl(key)"></a>
            </li>
        </ul>

        <div class="tab-content" id="dashboard-schedules-content-tabs-content">
            <div :class="navTabStyle(key)" :id="key" role="tabpanel" :aria-labelledby="setTabId(key)" v-for="(item, key) in items">
                <component :is="componentList[key]"></component>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardSchedulesList from './DashboardSchedulesList';
    import DashboardSchedulesPolesList from './DashboardSchedulesPolesList';
    import DashboardSchedulesCategoriesList from './DashboardSchedulesCategoriesList';

    export default {
        name: "dashboard-schedules-content",

        components: {
            DashboardSchedulesList,
            DashboardSchedulesPolesList
        },

        props: {
            activeTab: {
                type: String,
                default: "horarios"
            }
        },

        data() {
            return {
                items: {
                    "horarios": "Horários",
                    "polos": "Polos",
                    "categorias": "Categorias"
                },

                componentList: {
                    horarios: DashboardSchedulesList,
                    polos: DashboardSchedulesPolesList,
                    categorias: DashboardSchedulesCategoriesList
                }
            };
        },

        methods: {
            changeUrl(key) {
                let newUrl = window.location.pathname + '?mostrar=' + key;

                window.history.pushState({}, null, newUrl);
            },

            navLinkStyle(key) {
                return key === this.activeTab ? "nav-link active" : "nav-link";
            },

            navTabStyle(key) {
                return key === this.activeTab ? "tab-pane fade show active" : "tab-pane fade";
            },

            setTabId(key) {
                return "dashboard-schedules-" + key + "-tab";
            }
        }
    }
</script>