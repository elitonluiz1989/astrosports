require('./bootstrap');

import {PhotosGallery} from "./components/Photos/PhotosGallery.js";
import {HomeHistory} from "./components/Home/HomeHistory";
import {VideosModal} from "./components/Videos/VideosModal";

import Vue from 'vue';

import Imc from './components/Imc/Imc';
import ContactAddress from './components/Contact/ContactAddress';
import ContactEmail from './components/Contact/ContactEmail';
import DashboardLogin from './components/Dashboard/DashboardLogin';
import Dashboard from './components/Dashboard/Dashboard';

const app = new Vue({
    el: "#app",
    components: {
        Imc,
        ContactAddress,
        ContactEmail,
        DashboardLogin,
        Dashboard
    }
});

HomeHistory();

PhotosGallery();

VideosModal();

