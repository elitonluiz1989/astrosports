<template>
    <div class="row localization">
        <h2 class="contact__section-title">Localização</h2>

        <div class="col-12">
            <div class="localization__text localization__title">{{ title }}</div>
            <div class="localization__text">{{ address }}</div>
        </div>

        <div class="col-12" v-if="hasErrors">
            <div class="localization__error">{{ errorMessage }}</div>
        </div>

        <div class="col-12" v-if="!hasErrors">
            <contact-map :class="'localization__map'" :address="address" :zoom="zoom" :marker-title="title" :map-info="mapInfo"></contact-map>
        </div>
    </div>
</template>

<script>
    import AppMap from '../Base/AppMap';

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
            'contact-map': AppMap
        }
    }
</script>
