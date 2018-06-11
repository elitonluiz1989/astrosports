require('./bootstrap');

import {PhotosGallery} from "./components/Photos/PhotosGallery.js";
import {HomeHistory} from "./components/Home/HomeHistory";
import {VideosModal} from "./components/Videos/VideosModal";

import Vue from 'vue';

import Utils from './utils';
import store from './store';
import components from './components';

Vue.use(Utils);

const app = new Vue({
    store,
    components: components
}).$mount("#app");

HomeHistory();

PhotosGallery();

VideosModal();

