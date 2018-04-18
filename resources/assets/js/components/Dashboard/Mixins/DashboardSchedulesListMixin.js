export default {
    data() {
        return {
            sortByDesc: false,
            contentToSort: [],
            recordKey: null,
            recordId: 0,
            editForm: null,
            showDeleteModal: false
        };
    },

    methods: {
        hideModal() {
            this.showDeleteModal = false;
        },

        showDeleteMessage(id) {
            this.recordId = id;
            this.showDeleteModal = true;
        },

        showEditForm(key) {
            this.recordKey = key;
            this.editForm.triggerShowEditForm();
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
}