import Vue from 'vue';
import Vuex from 'vuex';

import { auth } from './modules/auth';
import { users } from './modules/users';
import { usersRoles } from './modules/users/userRoles';

import { schedules } from './modules/schedules';
import { schedulesPoles } from './modules/schedulesPoles';
import { schedulesCategories } from './modules/schedulesCategories';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        user: users,
        usersRoles: usersRoles,
        schedules: schedules,
        schedulesPoles: schedulesPoles,
        schedulesCategories: schedulesCategories
    }
});