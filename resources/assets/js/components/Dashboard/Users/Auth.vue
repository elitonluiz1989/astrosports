 <template>
    <div class="dashboard__auth">
        <div class="dashboard__auth-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <button class="dashboard__auth-logout" @click="userLogout">Sair</button>
    </div>
</template>

<script>
    import StoreRequestStatus from '@components/Base/Mixins/StoreRequestStatus';
    import UserInfoMixin from './Mixins/UserInfoMixin';

    export default {
        name: "dashboard-auth-user",

        mixins: [
            StoreRequestStatus,
            UserInfoMixin
        ],

        computed: {
            user() {
                return this.$store.getters.getAuthUser;
            }
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