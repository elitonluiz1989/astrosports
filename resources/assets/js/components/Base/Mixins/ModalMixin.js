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
        };
    },

    watch: {
        show(value) {
            if (value) {
                $('#' + this.modalId).modal('show');
            } else {
                $('#' + this.modalId).modal('hide');
            }
        }
    },

    mounted() {
        // It's is because if a bind a vue event in modal root to change show property in parent, the modal close when
        // there's a click/touch in modal content
        $('#' + this.modalId).on('hidden.bs.modal', evt => {
            this.hideModal();
        });
    },

    methods: {
        hideModal() {
            this.$emit('hideModal');
        }
    }
}