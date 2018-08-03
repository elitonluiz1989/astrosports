<template>
    <div class="dashboard__schedules container-fluid">
        <div class="dashboard-tabs">
            <ul class="nav nav-tabs" id="dashboard-schedules-content-tabs" role="tablist">
                <li class="nav-item" v-for="(item, key) in items" :key="key">
                    <a :class="navLinkStyle(key)"
                       :id="setTabId(key)"
                       data-toggle="tab"
                       :href="'#' + key"
                       role="tab"
                       :aria-controls="key"
                       aria-selected="true"
                       v-text="item"
                       @click="changeUrl(key)"></a>
                </li>
            </ul>

            <div class="tab-content" id="dashboard-schedules-content-tabs-content">
                <div :class="navTabStyle(key)"
                     :id="key"
                     role="tabpanel"
                     :aria-labelledby="setTabId(key)"
                     v-for="(item, key) in items"
                     :key="key">
                    <keep-alive>
                        <component :is="componentList[key]" />
                    </keep-alive>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TabsMixin from '@components/Base/Mixins/TabsMixin';
    import SchedulesList from './Schedules/List';
    import SchedulesPolesList from './Poles/List';
    import SchedulesCategoriesList from './Categories/List';

    export default {
        name: "dashboard-schedules",

        components: {
            SchedulesList,
            SchedulesPolesList,
            SchedulesCategoriesList
        },

        mixins: [
            TabsMixin
        ],

        data() {
            return {
                recordKey: {
                    schedules: null,
                    poles: null,
                    categories: null
                },
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
            }
        },

        created() {
            this.$store.dispatch('loadSchedules');
            this.$store.dispatch("loadSchedulesPoles");
            this.$store.dispatch("loadSchedulesCategories");

            this.defaultTab = "horarios";
        }
    }
</script>