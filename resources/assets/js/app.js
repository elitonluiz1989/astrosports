require('./bootstrap');

import { PhotosGallery } from "./components/Photos/PhotosGallery.js";
import { HomeHistory } from "./components/Home/HomeHistory";
import { VideosModal } from "./components/Videos/VideosModal";

import Vue from 'vue';

import { capitalize } from './helpers/utils';
import VueUtils from './helpers/vue-utils';
import VueRequest from './helpers/vue-request';
import store from './store';
import AppIcon from './components/Base/AppIcon';
import RootComponents from './components';

Vue.use(VueUtils);

Vue.use(VueRequest);

/** Global filters */
Vue.filter("Capitalize", capitalize);

/** Global components */
Vue.component("app-icon", AppIcon);

const app = new Vue({
  store,
  components: RootComponents,
}).$mount("#app");

HomeHistory();

PhotosGallery();

VideosModal();
