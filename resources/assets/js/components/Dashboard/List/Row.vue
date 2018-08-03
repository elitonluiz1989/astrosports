<template>
    <div :class="styles">
        <div class="dashboard-list__controller" v-if="isControlRow">
            <slot></slot>
        </div>

        <div class="dashboard-list--default"  v-if="isEmptyRow">
            <div class="dashboard-list--empty" v-text="emptyRowMessage"></div>
        </div>

        <slot v-if="isDefaultRow || isHeaderRow"></slot>
    </div>
</template>

<script>
    export default {
        name: "dashboard-list-row",

        props: {
            emptyMessage: {
                type: String
            },

            rowType: {
                type: String
            },
        },

        computed: {
            emptyRowMessage() {
                return this.emptyMessage || "Sem registros.";
            },

            isControlRow() {
                return this.rowType === "control";
            },

            isDefaultRow() {
                return !this.isControlRow && !this.isEmptyRow && !this.isHeaderRow;
            },

            isEmptyRow() {
                return this.rowType === "empty";
            },

            isHeaderRow() {
                return this.rowType === "header";
            },

            styles() {
                return {
                    "row": this.isControlRow,
                    "dashboard-list__row": this.isDefaultRow || this.isEmptyRow,
                    "dashboard-list__header d-none d-sm-flex": this.isHeaderRow
                };
            }
        }
    }
</script>