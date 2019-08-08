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

            <div class="tab-content" id="dashboard-commission-tabs-content">
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
    import { mapActions } from 'vuex';
    import RolesList from './Roles/List';
    import CommissionList from './Commission/List';

    export default {
        name: "dashboard-commission",

        components: {
            RolesList,
            CommissionList
        },

        mixins: [
            TabsMixin
        ],

        data() {
            return {
                items: {
                    comissao: "Comissão",
                    cargos: "Cargos"
                },

                componentList: {
                    comissao: CommissionList,
                    cargos: RolesList,
                }
            };
        },

        created() {
            this.loadRoles();
            this.loadCommission();

            this.defaultTab = "comissao";
        },

        methods: {
            ...mapActions({
                loadRoles: 'commissionRoles/load',
                loadCommission: 'commission/load'
            })
        }
    }
</script>
