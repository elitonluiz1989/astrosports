<template>
    <button :class="cssClass" ref="btn">
        <app-icon :icon="icon" :size="iconSize"></app-icon>
    </button>
</template>

<script>
    export default {
        name: "dashboard-list-button",

        props: {
            cssClass: {
                type: String,
                default: "dashboard-list__content dashboard-list__content--text col-6 col-reset"
            },

            isDisabled: {
               type: Boolean
            },

            icon: {
                type: String,
                required: true
            },

            iconSize: {
                type: String,
                default: "lg"
            }
        },

        watch: {
            isDisabled(value) {
                this.disableButton();
            }
        },

        mounted() {
            this.disableButton();
        },

        methods: {
            disableButton() {
                this.$refs.btn.disabled = !this.isSelfDefined(this.isDisabled);
            }
        }
    }
</script>