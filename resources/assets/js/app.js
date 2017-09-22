require('./bootstrap');

Vue.component('imc', require('./components/Imc/Imc.vue'));

const appImc = new Vue({
    el: "#app"
});