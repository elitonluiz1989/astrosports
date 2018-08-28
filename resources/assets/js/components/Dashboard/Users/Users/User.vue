<template>
    <div class="dashboard__user">
        <div class="mask">
            <div class="mask__content mask--dark"></div>
        </div>

        <div class="dashboard__user-controls">
            <i class="fa fa-2x fa-pencil" @click="triggerShowEditForm"></i>
            <i class="fa fa-2x fa-trash" @click="triggerShowDeleteForm"></i>
        </div>

        <div class="dashboard__user-avatar">
            <img :src="avatar" :alt="user.name" class="img">
        </div>

        <div class="dashboard__user-item" v-text="user.name"></div>

        <div class="dashboard__user-item" v-text="role"></div>

        <div class="dashboard__user-item" v-text="grant"></div>
    </div>
</template>

<script>
    import UserInfoMixin from '../Mixins/UserInfoMixin';

    export default {
        name: "user-info",

        mixins: [
            UserInfoMixin
        ],

        props: {
            userKey: {
                type: Number,
                required: true,
            }
        },

        data() {
            return {
                showUserMask: false,
                showUserControls: false
            };
        },

        computed: {
            user() {
                return this.$store.state.users.users[this.userKey];
            },

            role() {
                return this.validateUserInfo(this.user.role);
            },

            grant() {
                return this.validateUserInfo(this.user.role.grant);
            }
        },

        methods: {
            triggerShowDeleteForm() {
                this.$emit("triggerShowDeleteForm", this.user.id);
            },

            triggerShowEditForm() {
                this.$emit("triggerShowEditForm", this.userKey);
            },

            validateUserInfo(info) {
                let result = info || "-";
                result = result.name || "-";

                return this.$options.filters.Capitalize(result);
            }
        }
    }
</script>