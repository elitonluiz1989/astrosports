<template>
    <div class="dashboard-list">
        <dashboard-request-status-message :code="loadUsersRolesStatus.code"
                                          :message="loadUsersRolesStatus.messages"></dashboard-request-status-message>

        <users-role-edit-form :record-key="recordKey" :show="showEditModal" @hideModal="hideModal"></users-role-edit-form>

        <div class="row">
            <div class="dashboard-list__controller">
                <users-role-insert-form></users-role-insert-form>
            </div>
        </div>

        <div class="dashboard-list__title d-none d-sm-flex">
            <div class="dashboard-list__id dashboard-list__title-item" @click.stop="sortBy('id')" :title="listItems.id.message">
                <div class="dashboard-list__content" v-text="listItems.id.title"></div>
            </div>

            <div class="dashboard-list--default dashboard-list__title-item" @click.stop="sortBy('role')" :title="listItems.role.message">
                <div class="dashboard-list__content" v-text="listItems.role.title"></div>
            </div>

            <div class="dashboard-list__control dashboard-list__title-item" v-if="roles.length > 0">
                <div class="dashboard-list__content"></div>
            </div>
        </div>

        <div class="dashboard-list__row" v-if="roles.length === 0">
            <div class="dashboard-list--default">
                <div class="dashboard-list--empty">Sem registros.</div>
            </div>
        </div>

        <div class="dashboard-list__row" v-for="(role, key) in roles" :key="key" v-if="loadUsersRolesStatus.code === 2">
            <div class="dashboard-list__id">
                <div class="row d-sm-none">
                    <div class="dashboard-list__content dashboard-list__content--title col-6 col-reset" v-text="listItems.id.title"></div>
                    <div class="dashboard-list__content dashboard-list__content--text col-6 col-reset" v-text="role.id"></div>
                </div>

                <div class="dashboard-list__content d-none d-sm-block" v-text="role.id"></div>
            </div>

            <div class="dashboard-list--default dashboard__list--bordered">
                <div class="row d-sm-none">
                    <div class="dashboard-list__content dashboard-list__content--title col-6 col-reset" v-text="listItems.role.title"></div>
                    <div class="dashboard-list__content dashboard-list__content--text col-6 col-reset" v-text="role.name"></div>
                </div>

                <div class="dashboard-list__content d-none d-sm-block" v-text="role.name"></div>
            </div>

            <div class="dashboard-list__control">
                <div class="row">
                    <button class="dashboard-list__content dashboard-list__content--text col-6 col-reset"
                            @click.stop="showEditForm(key)">
                        <app-icon icon="pencil" size="lg"></app-icon>
                    </button>

                    <button class="dashboard-list__content dashboard-list__content--text col-6 col-reset"
                            @click.stop="showDeleteMessage(role.id)">
                        <app-icon icon="trash" size="lg"></app-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardListMixin from '@Dashboard/Mixins/DashboardListMixin';
    import UsersRoleInsertForm from './Insert';
    import UsersRoleEditForm from './Edit';

    export default {
        name: "users-roles-list",

        components: {
            UsersRoleInsertForm,
            UsersRoleEditForm
        },

        mixins: [
            DashboardListMixin
        ],

        data() {
            return {
                listItems: {
                    id: {
                        title: "Cod.",
                        message: "Clique para ordernar por código"
                    },
                    role: {
                        title: "Cargo",
                        message: "Clique para ordernar por código"
                    }
                }
            };
        },

        computed: {
            roles() {
                return this.$store.getters.getUsersRoles;
            },

            loadUsersRolesStatus() {
                return this.storeRequestStatus("getLoadUsersRolesStatus", "getUsersRolesMessageErrors")
            }
        },

        watch: {
            roles(value) {
                this.contentToSort = value;
            }
        }
    }
</script>