<template>
    <div class="dashboard__users container-fluid">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />
        
        <user-insert-form :show="showInsertModal" 
                           @hideModal="hideModal" />
        <user-edit-form :record-key="recordKey"
                        :show="showEditModal"
                        @hideModal="hideModal" />

        <div :class="styles.usersRow" v-if="!dataLoaded && loadStatus.code == 2">
            <insert-user-button @showInsertForm="showInsertForm" />
        </div>

        <div :class="styles.usersRow" v-if="dataLoaded">
            <div class="dashboard__users-item"
                v-for="(user, key) in records"
                :key="key">
                <user-info :user-key="key"
                            @triggerShowEditForm="showEditForm"
                            @triggerShowDeleteForm="showDeleteMessage"></user-info>
            </div>

            <insert-user-button @showInsertForm="showInsertForm" />
        </div>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import { mapState } from 'vuex';
    import InsertUserButton from './InsertUserButton.vue';
    import UserInfo from './User';
    import UserInsertForm from './Insert';
    import UserEditForm from './Edit';

    export default {
        name: "users-lists",

        components: {
            InsertUserButton,
            UserInfo,
            UserInsertForm,
            UserEditForm
        },

        mixins: [
            DashboardListMixin
        ],

        computed: {
            ...mapState({store: 'users'}),

            records() {
                return this.store.records;
            },

            styles() {
                return {
                    usersRow: 'row justify-content-center justify-content-sm-around justify-content-md-start'
                }
            },

            pagination() {
                return this.store.pagination;
            },

            loadStatus() {
                return this.store.status.load;
            }
        }
    }
</script>
