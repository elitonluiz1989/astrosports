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
    import { CONFIG } from "@js/config";

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
                return this.member.avatar || CONFIG.PHOTOS.DEFAULT;
            },
            
            member() {
                return this.$store.state.commission.records[this.commissionKey];
            },

            role() {
                return this.validateCommissionMemberRole(this.member.roles);
            }
        },

        methods: {
            triggerShowDeleteForm() {
                this.$emit("triggerShowDeleteForm", this.member.id);
            },

            triggerShowEditForm() {
                this.$emit("triggerShowEditForm", this.commissionKey);
            },

            validateCommissionMemberRole(member) {
                let result = member || "-";
                result = result.name || "-";

                return this.$options.filters.Capitalize(result);
            }
        }
    }
</script>