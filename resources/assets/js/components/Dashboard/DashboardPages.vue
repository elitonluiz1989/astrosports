<template>
    <div class="dashboard__content">
        <keep-alive>
            <component :is="currentPage.component" v-if="isAllowed"></component>
        </keep-alive>

        <div class="dashboard__content--empty" v-if="!isAllowed">
            <div class="alert alert-danger text-center w-75 m-auto" v-text="isNotAllowedMessage"></div>
        </div>
    </div>
</template>

<script>
    import {pages} from './data/pages';

    export default {
        name: "dashboard-pages",

        props: {
            page: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                isNotAllowedMessage: "Seu usuário não possui permissão para acessar essa página."
            }
        },

        computed: {
            currentPage() {
                return pages[this.page];
            },

            isAllowed() {
                if(!this.isNullOrEmpty(this.currentPage.userGrant) && this.currentPage.userGrant > 0) {
                    return this.userIsAllowed(this.currentPage.userGrant);
                } else {
                    return true;
                }
            }
        }
    }
</script>