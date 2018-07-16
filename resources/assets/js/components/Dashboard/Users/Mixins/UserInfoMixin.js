import { CONFIG } from "@js/config";

export default {
    computed: {
        avatar() {
            if (this.user.avatar) {
                return CONFIG.PHOTOS.PATH + this.user.avatar;
            } else {
                return CONFIG.PHOTOS.DEFAULT;
            }
        },
    }
};