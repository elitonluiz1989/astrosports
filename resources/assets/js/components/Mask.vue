<template>
    <div class="mask" :class="maskStyles" ref="mask">
        <mask-loader :show-loader="showMask" :loader-message="loaderMessage" v-if="hasLoader"></mask-loader>
    </div>
</template>

<script>
    import Loader from './Loader';

    export default {
        name: 'Mask',

        props: {
            maskLight: {
                type: Boolean,
                default: true
            },

            maskDark: {
                type: Boolean,
                default: false
            },

            showMask: {
                type: Boolean,
                default: false,
            },

            fullScreen: {
                type: Boolean,
                default: false
            },

            hasLoader: {
                type: Boolean,
                default: true
            },

            loaderMessage: {
                type: String,
                default: ''
            }
        },

        data() {
          return {
            t: this.fullScreen
          }
        },

        components: {
            'mask-loader': Loader
        },

        computed: {
            maskStyles() {
                return {
                    'mask--show': this.showMask,
                    'mask--light': this.maskLight,
                    'mask--dark': this.maskDark
                }
            }
        },

        watch: {
            t: function(value) {
                console.log(this.$refs)
            }
        }
    }
</script>

<style lang="scss">
    .mask {
        display: none;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 9999;
        opacity: 0;
        transition: opacity 1s;

        &--light {
            background-color: white;
        }

        &--dark {
            background-color: black;
        }

        &--show {
            display: block;
            opacity: .8;
        }
    }


</style>