<template>
    <div class="loader" v-bind:class="TheLoaderStyle">
        <div class="spinner"></div>

        <p class="loader__message" v-if="loaderMessage != ''">{{ loaderMessage }}</p>
    </div>
</template>

<script>
    export default {
        name: 'TheLoader',

        props: {
            hideLoader: {
                type: Boolean,
                default: false
            },

            loaderMessage: {
                type: String,
                default: ''
            },

            floatingLoader: {
                type: Boolean,
                default: true
            },

            showLoader: {
                type: Boolean,
                default: false
            },
        },

        computed: {
            TheLoaderStyle: function() {
                return {
                    'loader--show': this.showLoader,
                    'loader--hide': this.hideLoader,
                    'loader--floating': this.floatingLoader,
                    'loader--static': !this.floatingLoader,
                }
            }
        }

    }
</script>

<style lang="scss">
    .loader {
        background-color: transparent;
        opacity: 0;
        transition: display, opacity 1s;

        &--show {
            display: block;
            opacity: 1;
        }

        &--hide {
            display: none;
        }

        &--floating {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -35px;
            margin-left: -35px;
        }

        &--static {
            padding: 5px 0;
        }

        &__message {
            margin: 0;
            padding: 4px 0;
            text-align: center;
            font-size: 12px;
        }
    }
</style>
