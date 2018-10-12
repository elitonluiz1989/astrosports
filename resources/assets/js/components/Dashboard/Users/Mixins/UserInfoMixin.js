import { CONFIG } from "@js/config";

export default {
    computed: {
        avatar() {
            return this.user.avatar || CONFIG.PHOTOS.DEFAULT;
        },
    }
};