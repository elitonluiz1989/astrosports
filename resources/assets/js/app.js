import {PhotosGallery} from "./components/Photos/PhotosGallery.js";
import {HomeHistory} from "./components/Home/HomeHistory";
import {VideosModal} from "./components/Videos/VideosModal";

require('./bootstrap');

Vue.component('main-mask', require('./components/Base/TheMask'));

Vue.component('imc', require('./components/Imc/Imc'));

Vue.component('contact-address', require('./components/Contact/ContactAddress'));

Vue.component('contact-email', require('./components/Contact/ContactEmail'));

const appImc = new Vue({
    el: "#app"
});

HomeHistory();

PhotosGallery();

VideosModal();