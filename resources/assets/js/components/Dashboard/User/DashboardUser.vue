<template>
    <div class="dashboard__user">
        <div class="dashboard__user-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <div class="dashboard__user-name" v-text="user.name"></div>

        <button class="dashboard__user-logout" @click="userLogout">Sair</button>
    </div>
</template>

<script>
    import { CONFIG } from '../../../config';
    export default {
        name: "dashboard-user",

        created() {
            this.$store.dispatch('loadAuthUser');
        },

        computed: {
            avatar() {
                if (this.user.avatar) {
                    return CONFIG.PHOTOS.PATH + this.user.avatar;
                } else {
                    return CONFIG.PHOTOS.DEFAULT;
                }
            },

            user() {
                return this.$store.getters.getAuthUser;
            }
        },

        methods: {
            userLogout() {
                this.$emit('onUserLogout');
            }
        }
    }
</script>