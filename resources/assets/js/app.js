import {PhotosGallery} from "./components/Photos/PhotosGallery.js";

require('./bootstrap');

Vue.component('main-mask', require('./components/Base/TheMask'));

Vue.component('imc', require('./components/Imc/Imc'));

Vue.component('contact-address', require('./components/Contact/ContactAddress'));

Vue.component('contact-email', require('./components/Contact/ContactEmail'));

const appImc = new Vue({
    el: "#app"
});

(() => {
    /**
    * Home History
    */
    const homeHistory = $('#home-history');
    const homeHistoryToggleBtn = $('#home-history-toggle');
    let homeHistoryExpand = false;
    let scrollY = 0;

    homeHistoryToggleBtn.click((evt) => {
        evt.preventDefault();

        homeHistoryExpand = !homeHistoryExpand;

        if (homeHistoryExpand) {
            scrollY = window.scrollY;
            homeHistory.addClass('home__history--expand');

            setTimeout(() => {
                homeHistoryToggleBtn.html('Ocultar texto.');
            }, 1000);

        } else {
            homeHistory.removeClass('home__history--expand');

            $('html, body').animate({scrollTop: scrollY}, 1000, function() {
                homeHistoryToggleBtn.html('Continue lendo...');
            });
        }
    });
 })();

PhotosGallery();