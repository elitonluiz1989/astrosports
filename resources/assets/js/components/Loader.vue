<template>
    <div class="loader" v-bind:class="appLoaderStyle">
        <div class="spinner"></div>

        <p class="loader__message" v-if="loaderMessage != ''">{{ loaderMessage }}</p>
    </div>
</template>

<script>
    export default {
        name: 'Loader',

        props: {
            showLoader: {
                type: Boolean,
                default: false
            },
            hideLoader: {
                type: Boolean,
                default: false
            },
            loaderMessage: {
                type: String,
                default: ''
            },
        },

        computed: {
            appLoaderStyle: function() {
                return {
                    'loader--show': this.showLoader,
                    'loader--hide': this.hideLoader
                }
            }
        }

    }
</script>

<style lang="scss">
    .loader {
        background-color: white;
        padding-top: 5px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -35px 0 0 -35px;
        opacity: 0;
        transition: display, opacity 1s;

        &__message {
            margin: 0;
            padding: 4px 0;
            text-align: center;
            font-size: 12px;
        }

        &--show {
            display: block;
            opacity: 1;
        }

        &--hide {
            display: none;
        }
    }
</style>