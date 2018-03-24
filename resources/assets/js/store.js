import Vue from 'vue';
import Vuex from 'vuex';

import { dashboardNavItems } from "./modules/dashboardNavItems";
import { auth } from './modules/auth'
import { users } from './modules/users'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        dashboardNavItems: dashboardNavItems,
        auth: auth,
        user: users
    }
});