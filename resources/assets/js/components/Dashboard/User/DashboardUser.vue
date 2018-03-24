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
    import StoreRequestStatus from '../../Base/Mixins/StoreRequestStatus';

    export default {
        name: "dashboard-user",

        mixins: [
            StoreRequestStatus
        ],

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

        created() {
            this.$store.dispatch('loadAuthUser');
            this.requestMessageOnLog = true;
        },

        mounted() {
          this.storeRequestStatus('getAuthRequestStatus', 'getAuthMessageErrors');
        },

        methods: {
            userLogout() {
                this.$emit('onUserLogout');
            }
        }
    }
</script>