<template>
    <i :class="iconClass" aria-hidden="true"></i>
</template>

<script>
    export default {
        name: "app-icon",

        props: {
            flip: {
                type: String,
            },

            fixedWidth: {
                type: Boolean,
                default: false
            },

            hasBorder: {
                type: Boolean,
                default: false
            },

            icon: {
                type: String,
                required: true
            },

            prefix: {
                type: String,
                default: "fa"
            },

            pull: {
                type: String,
            },

            rotate: {
                type: Number,
                default: 0
            },

            size: {
                type: String,
            }
        },

        data() {
            return {
                flipOptions: {
                    horizontal: " fa-flip-horizontal",
                    vertical: " fa-flip-vertical",
                },

                pullOptions: {
                    left: " fa-pull-left",
                    right: " fa-pull-right",
                },

                rotateDegrees: {
                    90: " fa-rotate-90",
                    180: " fa-rotate-180",
                    270: " fa-rotate-270",
                },

                sizes: {
                    lg: " fa-lg",
                    "2x": " fa-2x",
                    "3x": " fa-3x",
                    "4x": " fa-4x",
                    "5x": "  fa-5x"
                }
            }
        },

        computed: {
            iconClass() {
                let icon = this.prefix + " fa-" + this.icon;

                if (!this.isNullOrEmpty(this.flip)) {
                    icon += this.flipOptions[this.flip];
                }

                if (this.isSelfDefined(this.fixedWidth)) {
                    icon += " fa-fw";
                }

                if (this.isSelfDefined(this.hasBorder)) {
                    icon += " fa-border";
                }

                if (!this.isNullOrEmpty(this.pull)) {
                    icon += this.pullOptions[this.pull];
                }

                if (this.rotate > 0) {
                    icon += this.rotateDegrees[this.rotate];
                }

                if (!this.isNullOrEmpty(this.size)) {
                    icon += this.sizes[this.size];
                }

                return icon;
            }
        }
    }
</script>