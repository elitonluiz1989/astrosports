<template>
    <div class="dashboard__users container-fluid">
        <dashboard-request-message :code="loadStatus.code"
                                   :message="loadStatus.messages" />
        
        <commission-insert-form :show="showInsertModal" 
                                @hideModal="hideModal" />

        <commission-edit-form :record-key="recordKey"
                            :show="showEditModal"
                            @hideModal="hideModal" />

        <commission-delete-modal type-record="commission"
                                :record-id="recordId"
                                :show="showDeleteModal"
                                @hideModal="hideModal" />

        <div :class="styles.comissionRow" v-if="!dataLoaded && loadStatus.code === 2">
            <insert-commission-member-button @showInsertForm="showInsertForm" />
        </div>

        <div :class="styles.comissionRow" v-if="dataLoaded">
            <div class="dashboard__users-item"
                v-for="(user, key) in records"
                :key="key">
                <commission-member :commission-key="key"
                                    @triggerShowEditForm="showEditForm"
                                    @triggerShowDeleteForm="showDeleteMessage" />
            </div>

            <insert-commission-member-button @showInsertForm="showInsertForm" />
        </div>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import { mapState } from 'vuex';
    import InsertCommissionMemberButton from './InsertComissionMemberButton';
    import CommissionMember from './CommissionMember';
    import CommissionInsertForm from './Insert';
    import CommissionEditForm from './Edit';
    import CommissionDeleteModal from '../Delete';

    export default {
        name: "commission-lists",

        components: {
            InsertCommissionMemberButton,
            CommissionMember,
            CommissionInsertForm,
            CommissionEditForm,
            CommissionDeleteModal
        },

        mixins: [
            DashboardListMixin
        ],

        computed: {
            ...mapState({store: 'commission'}),

            records() {
                return this.store.records;
            },

            styles() {
                return {
                 comissionRow: 'row justify-content-center justify-content-sm-around justify-content-md-start'
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
