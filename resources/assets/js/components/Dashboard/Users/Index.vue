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
    import GrantsList from './Grants/List';
    import RolesList from './Roles/List';
    import UsersList from './Users/List';

    export default {
        name: "dashboard-users",

        components: {
            GrantsList,
            RolesList,
            UsersList
        },

        mixins: [
            TabsMixin
        ],

        data() {
            return {
                items: {
                    usuarios: "Usuários",
                    cargos: "Cargos",
                    permissoes: "Permissões"
                },

                componentList: {
                    usuarios: UsersList,
                    cargos: RolesList,
                    permissoes: GrantsList
                }
            };
        },

        created() {
            this.$store.dispatch('loadUserGrants');
            this.$store.dispatch('loadUserRoles');
            this.$store.dispatch('loadUsers');

            this.defaultTab = "usuarios";
        }
    }
</script>
