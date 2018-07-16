require('./bootstrap');

import {PhotosGallery} from "./components/Photos/PhotosGallery.js";
import {HomeHistory} from "./components/Home/HomeHistory";
import {VideosModal} from "./components/Videos/VideosModal";

import Vue from 'vue';

import Utils from './vue-utils';
import store from './store';
import AppIcon from './components/Base/AppIcon';
import RootComponents from './components';

Vue.use(Utils);

/** Global components */
Vue.component("app-icon", AppIcon);

const app = new Vue({
    store,
    components: RootComponents
}).$mount("#app");

HomeHistory();

PhotosGallery();

VideosModal();

