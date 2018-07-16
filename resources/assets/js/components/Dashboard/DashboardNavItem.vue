<template>
    <a :class="style" :href="navLink">
        <app-icon :icon="icon" fixed-width v-if="icon"></app-icon>

        <span class="d-md-none" v-text="text"></span>

        <div class="nav-info" v-text="text"></div>
    </a>
</template>

<script>
    export default {
        name: "dashboard-nav-item",

        props: {
            link: {
                type: String,
                default: "#"
            },

            active: {
                type: Boolean
            },

            icon: {
                type: String
            },

            text: {
                type: String
            }
        },

        computed: {
            style() {
                return {
                    "nav-link": this.active,
                    "nav-link disabled": !this.active,
                };
            },

            navLink() {
                return this.active ? this.link : "javascript:;";
            }
        }
    }
</script>