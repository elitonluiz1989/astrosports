<template>
    <div class="form-group send-email__message" :class="contactEmailMessageStyles.show">
        <p class="alert" :class="[ contactEmailMessageStyles.error, contactEmailMessageStyles.success ]">{{ message }}</p>
    </div>
</template>

<script>
    export default {
        name: 'ContactEmailMessage',

        props: {
            message: {
                type: String,
                default: ''
            },

            error: {
                type: Boolean,
                default: false
            },

            success: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            contactEmailMessageStyles(){
                return {
                    show: {
                        'send-email__message--show': this.error || this.success
                    },

                    error: {
                        'alert-danger': this.error
                    },

                    success: {
                        'alert-success': this.success
                    }
                };
            }
        }
    }
</script>