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
            <img :src="avatar" :alt="member.name" class="img">
        </div>

        <div class="dashboard__user-item" v-text="member.name"></div>

        <div class="dashboard__user-item" v-text="role"></div>
    </div>
</template>

<script>
    export default {
        name: "commission-member",

        props: {
            commissionKey: {
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
            avatar() {
                return this.user.avatar || CONFIG.PHOTOS.DEFAULT;
            },
            
            member() {
                return this.$store.state.commission.records[this.userKey];
            },

            role() {
                return this.validateUserInfo(this.user.role);
            }
        },

        methods: {
            triggerShowDeleteForm() {
                this.$emit("triggerShowDeleteForm", this.user.id);
            },

            triggerShowEditForm() {
                this.$emit("triggerShowEditForm", this.userKey);
            },

            validateCommissionMember(member) {
                let result = member || "-";
                result = result.name || "-";

                return this.$options.filters.Capitalize(result);
            }
        }
    }
</script>