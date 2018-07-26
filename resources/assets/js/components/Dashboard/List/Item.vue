<template>
    <div :class="itemStyle">
        <!-- Shows when list item type is header list -->
        <div class="dashboard-list__content" :title="itemTitle" v-text="itemText" v-if="isHeader"></div>

        <!-- Shows when list item type is list content -->
        <div :class="itemRowStyle" v-if="isDefault">
            <div class="dashboard-list__content dashboard-list__content--title col-6 col-reset" v-text="itemTitle"></div>
            <div class="dashboard-list__content dashboard-list__content--text col-6 col-reset" v-text="itemText"></div>
        </div>

        <div class="dashboard-list__content d-none d-sm-block" v-text="itemText" v-if="isDefault"></div>

        <!-- Shows when list item type is control buttons -->
        <div class="row row-reset" v-if="isController">
            <dashboard-list-button icon="pencil"
                                   :is-disabled="hasEditKey"
                                   @click.stop="showEditForm(itemEditKey)"></dashboard-list-button>

            <dashboard-list-button icon="trash"
                                   :is-disabled="hasDeleteId"
                                   @click.stop="showDeleteMessage(itemDeleteId)"></dashboard-list-button>
        </div>
    </div>
</template>

<script>
    import DashboardListButton from "./Button";

    export default {
        name: "dashboard-list-item",
        components: {DashboardListButton},
        props: {
            bordered: {
                type: Boolean
            },

            itemDeleteId: {
                type: Number
            },

            itemEditKey: {
                type: Number
            },

            itemId: {
                type: String,
            },

            itemType: {
                type: String,
            },

            itemTitle: {
                type: String
            },

            itemText: {
                type: String|Number
            }
        },

        computed: {
            hasEditKey() {
                return !this.isNullOrUndefined(this.itemEditKey);
            },

            hasDeleteId() {
                return !this.isNullOrUndefined(this.itemDeleteId);
            },

            isController() {
                return this.itemType === "control";
            },

            isDefault() {
                return !this.isController && !this.isHeader;
            },

            isHeader() {
                return this.itemType === "header";
            },

            itemRowStyle() {
                return this.isNullOrEmpty(this.itemType) ? "row row-reset d-sm-none" : "row d-sm-none";
            },

            itemStyle() {
                let style = "dashboard-list";

                if (!this.isNullOrEmpty(this.itemId)) {
                    style += "__" + this.itemId;
                } else {
                    style += "--default"
                }

                if (this.isHeader) {
                    style += " dashboard-list__header-item";
                }

                if (this.isController) {
                    style += " dashboard-list__control";
                }

                if (this.isSelfDefined(this.bordered)) {
                    style += " dashboard-list--bordered";
                }

                return style;
            }
        },

        methods: {
            showDeleteMessage(id) {
                this.$parent.$emit("showDeleteMessage", id);
            },

            showEditForm(key) {
                this.$parent.$emit("showEditForm", key);
            }
        }
    }
</script>

<style scoped>

</style>