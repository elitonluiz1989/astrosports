export default {
    data() {
        return {
            tabIdPrefix: "",
            defaultTab: ""
        };
    },

    computed: {
        activeTab() {
            return this.getRequestParam("mostrar") || this.defaultTab;
        }
    },

    methods: {
        changeUrl(key) {
            let newUrl = window.location.pathname + '?mostrar=' + key;

            window.history.pushState({}, null, newUrl);
        },

        navLinkStyle(key) {
            return key === this.activeTab ? "nav-link active" : "nav-link";
        },

        navTabStyle(key) {
            return key === this.activeTab ? "tab-pane fade show active" : "tab-pane fade";
        },

        setTabId(key) {
            return this.tabIdPrefix + key + "-tab";
        }
    }
}