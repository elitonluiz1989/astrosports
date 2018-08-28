require('./bootstrap');

import {PhotosGallery} from "./components/Photos/PhotosGallery.js";
import {HomeHistory} from "./components/Home/HomeHistory";
import {VideosModal} from "./components/Videos/VideosModal";

import Vue from 'vue';

import VueUtils from './helpers/vue-utils';
import VueRequest from './helpers/vue-request';
import store from './store';
import AppIcon from './components/Base/AppIcon';
import RootComponents from './components';

Vue.use(VueUtils);

Vue.use(VueRequest);

/** Global filters */
Vue.filter("Capitalize", function(value) {
    if (!value) {
        return '';
    }

    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

/** Global components */
Vue.component("app-icon", AppIcon);

const app = new Vue({
    store,
    components: RootComponents,
}).$mount("#app");

HomeHistory();

PhotosGallery();

VideosModal();

