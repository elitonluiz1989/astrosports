<template>
    <div class="row localization">
        <h2 class="contact__section-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Localização</h2>

        <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ title }}</p>

        <p class="col-xs-12 col-lg-10 col-lg-offset-1">{{ address }}</p>

        <div class="col-xs-12 col-lg-10 col-lg-offset-1" v-if="hasErrors">
            <p class="localization__error">{{ errorMessage }}</p>
        </div>

        <div class="col-xs-12 col-lg-10 col-lg-offset-1" v-if="!hasErrors">
            <contact-map :class="'localization__map'" :address="address" :zoom="zoom" :marker-title="title" :map-info="mapInfo"></contact-map>
        </div>
    </div>
</template>

<script>
    import TheMap from '../Base/TheMap';

    export default {
        name: 'ContactAddress',

        props: {
            address: {
                type: String,
                required: true
            },

            title: {
                type: String,
                required: true
            },
        },

        data() {
            return {
                errorMessage: '',
                hasErrors: false,
                mapInfo: 'Escola de Futebol Astro Sports.<br><smal><strong>#Descobrindo valores.</strong></smal>',
                zoom: 18
            };
        },

        components: {
            'contact-map': TheMap
        }
    }
</script>