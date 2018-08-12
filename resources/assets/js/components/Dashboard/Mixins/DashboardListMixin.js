import StoreRequestStatusMixin from '@components/Base/Mixins/StoreRequestStatus';
import DashboardRequestMessage from '@Dashboard/DashboardRequestMessage';
import DashboardListRow from "@Dashboard/List/Row";
import DashboardListItem from "@Dashboard/List/Item";


export default {
    components: {
        DashboardRequestMessage,
        DashboardListItem,
        DashboardListRow,
    },

    mixins: [
        StoreRequestStatusMixin
    ],

    data() {
        return {
            sortByDesc: false,
            contentToSort: [],
            recordKey: null,
            recordId: 0,
            showEditModal: false,
            showDeleteModal: false,
            listItems: {
                id: {
                    title: "Cod.",
                    message: "Clique para ordernar por código"
                }
            }
        };
    },

    computed: {
        statusError() {
            return this.loadStatus.code === 3;
        },

        statusSuccess() {
            return this.loadStatus.code === 2;
        }
    },

    methods: {
        hideModal() {
            this.recordKey = null;
            this.recordId = 0;
            this.showDeleteModal = false;
            this.showEditModal = false;
        },

        showDeleteMessage(id) {
            this.recordId = id;
            this.showDeleteModal = true;
        },

        showEditForm(key) {
            this.recordKey = key;
            this.showEditModal = true;
        },

        sortBy(key) {
            this.contentToSort.sort((item1, item2) => {
                const val1 = typeof item1[key] === "string" ? item1[key].toUpperCase() : item1[key];
                const val2 = typeof item2[key] === "string" ? item2[key].toUpperCase() : item2[key];

                let comparison = 0;

                if (val1 > val2) {
                    comparison = 1;
                } else {
                    comparison = -1;
                }

                return this.sortByDesc ? (comparison * - 1) : comparison;
            });

            this.sortByDesc = !this.sortByDesc;
        },
    }
};