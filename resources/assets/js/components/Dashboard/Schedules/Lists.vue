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
    import SchedulesList from './Schedules/List';
    import SchedulesPolesList from './Poles/List';
    import SchedulesCategoriesList from './Categories/List';

    export default {
        name: "schedules-lists",

        components: {
            SchedulesList,
            SchedulesPolesList,
            SchedulesCategoriesList
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
                    horarios: SchedulesList,
                    polos: SchedulesPolesList,
                    categorias: SchedulesCategoriesList
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