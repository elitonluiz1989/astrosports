export default {
    props: {
        show: {
            type: Boolean,
            required: true,
            default: false
        }
    },

    data() {
        return {
            modalId: null
        }
    },

    watch: {
        show(value) {
            if (value) {
                $('#' + this.modalId).modal('show')
            } else {
                $('#' + this.modalId).modal('hide')
            }
        }
    },

    methods: {
        hideModal() {
            this.$emit('hideModal');
        }
    }
}