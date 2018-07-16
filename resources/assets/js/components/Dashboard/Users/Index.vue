<template>
    <div class="dashboard__users container-fluid">
        <div class="dashboard-tabs">
            <ul class="nav nav-tabs" id="dashboard-users-tabs-item" role="tablist">
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

            <div class="tab-content" id="dashboard-users-tabs-content">
                <div :class="navTabStyle(key)" :id="key" role="tabpanel" :aria-labelledby="setTabId(key)" v-for="(item, key) in items" :key="key">
                    <keep-alive>
                        <component :is="componentList[key]"></component>
                    </keep-alive>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TabsMixin from '@components/Base/Mixins/TabsMixin';
    import RolesList from './Roles/List';

    export default {
        name: "dashboard-users",

        components: {
            RolesList
        },

        mixins: [
            TabsMixin
        ],

        props: {
            activeTab: {
                type: String,
                default: "cargos"
            }
        },

        data() {
            return {
                items: {
                    cargos: "Cargos"
                },

                componentList: {
                    cargos: RolesList
                }
            };
        },

        created() {
            this.$store.dispatch('loadUsers');
            this.$store.dispatch('loadUsersRoles');
        }
    }
</script>
