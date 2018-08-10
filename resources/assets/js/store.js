import Vue from 'vue';
import Vuex from 'vuex';

import { auth } from './modules/users/auth';
import { users } from './modules/users/users';
import { userGrants } from './modules/users/userGrants';
import { userRoles } from './modules/users/userRoles';

import { schedules } from './modules/schedules';
import { schedulesPoles } from './modules/schedulesPoles';
import { schedulesCategories } from './modules/schedulesCategories';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        users: users,
        userGrants: userGrants,
        userRoles: userRoles,
        schedules: schedules,
        schedulesPoles: schedulesPoles,
        schedulesCategories: schedulesCategories
    }
});