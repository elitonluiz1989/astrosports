 <template>
    <div class="dashboard__auth">
        <div class="dashboard__auth-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <div class="dashboard__auth-popover">
            <div class="dashboard__auth-message" v-html="authMessage"></div>

            <div class="dashboard__auth-logout">
                <button class="dashboard__auth-logout-btn" @click="userLogout">
                    <app-icon icon="sign-out"></app-icon>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import StoreRequestStatus from '@components/Base/Mixins/StoreRequestStatus';
    import UserInfoMixin from './Mixins/UserInfoMixin';

    export default {
        name: "auth-user",

        mixins: [
            StoreRequestStatus,
            UserInfoMixin
        ],

        computed: {
            authMessage() {
                let message = "Bem-vindo";

                if (!this.isNullOrUndefined(this.user.name)) {
                    message += ", <strong>" + this.user.name + "</strong>";
                }

                return message;
            },

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