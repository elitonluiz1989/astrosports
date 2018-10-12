<template>
    <div ref="map"></div>
</template>

<script>
    import { CONFIG } from '../../config';

    export default {
        name: 'app-map',

        props: {
            address: {
                type: String
            },

            lang: {
                type: String,
                default: 'pt-br'
            },

            lat: {
                type: Number
            },

            long: {
                type: Number
            },

            mapInfo: {
                type: String,
            },

            mapType: {
                type: String,
                default: 'roadmap'
            },

            markerTitle: {
                type: String
            },

            name: {
                type: String,
            },

            scrollWheel: {
                type: Boolean,
                default: false
            },

            zoom: {
                type: Number,
                default: 4
            }
        },

        data() {
            return {
                errorMessage: 'Houve um erro ao carregar o mapa',
                hasErrors: false,
                geocoder: null,
                googleKey: CONFIG.GOOGLE_KEY,
                googleMaps: null,
                mapId: this.name || 'map-' + Math.random()
            };
        },

        watch: {
            hasErrors(has) {
                if (has) {
                    let message = document.createElement('div');
                    message.className = 'message-error alert alert-danger text-center';
                    message.innerText = this.errorMessage;

                    this.$refs.map.appendChild(message);
                }
            }
        },

        mounted() {
            this.initialize()
                .then(this.createMap, this.mapUnloaded);
        },

        methods: {
            createMap() {
                let settings = {
                    lang: this.lang,
                    scrollWheel: this.scrollWheel,
                    zoom: this.zoom
                };

                if (this.address) {
                    this.getMapByAddress(settings);
                } else if (this.lat && this.long) {
                    settings.center = {
                        lat: this.lat,
                        lng: this.long
                    };

                    this.getMap(settings);
                } else {
                    console.error('Vuejs Map Component: Latitude and longitude is necessary to load the map.');

                    this.hasErrors = true;
                }
            },

            initialize() {
                return new Promise((resolve, reject) => {
                    let script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + this.googleKey;
                    script.setAttribute('defer','');
                    script.setAttribute('async','');
                    script.onload = resolve;
                    script.onerror = reject;

                    document.body.appendChild(script);
                });
            },

            getMap(settings) {
                let map = new window.google.maps.Map(this.$refs.map, settings);

                let markerSettings = {
                    map: map,
                    position: settings.center
                };

                if (this.markerTitle) {
                    markerSettings.title = this.markerTitle;
                }

                let mapMarker = new window.google.maps.Marker(markerSettings);

                if (this.mapInfo && this.markerTitle) {
                    let content = '<div id="content">' +
                        '<div id="siteNotice"></div>' +
                        '<h1 id="firstHeading" class="firstHeading">' + this.markerTitle + '</h1>' +
                        '<div id="bodyContent">' + this.mapInfo + '</div>' +
                        '</div>';

                    let mapInfo = new window.google.maps.InfoWindow({content: content});

                    mapMarker.addListener('click', function() {
                        console.log('sss')
                        mapInfo.open(map, mapMarker);
                    });
                }
            },

            getMapByAddress(settings) {
                let geocoder = new window.google.maps.Geocoder();

                geocoder.geocode({address: this.address}, (results, status) => {
                    if (status == 'OK') {
                        settings.center = results[0].geometry.location;

                        this.getMap(settings);
                    } else {
                        console.error('Vue2 Map component: Error in get latitue and longitude from address.');
                        console.error(status);

                        this.hasErrors = true;
                    }
                });
            },

            mapUnloaded() {
                this.hasErrors = true;
            }
        }
    }
</script>

<style lang="scss">
    .message-error {
        margin: 10px 10px 0;
    }
</style>