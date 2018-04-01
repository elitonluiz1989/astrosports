<template>
    <div class="row justify-content-center" v-show="code === 1 && code === 3">
        <div class="col-12 col-lg-10">
            <div :class="styles.alert" v-text="messageStatus"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dashboard-request-status-message",

        props: {
            code: {
                type: Number,
                required: true
            },

            message: {
                type: String
            }
        },

        computed: {
            styles() {
                return {
                    alert: {
                        'alert alert-warning text-center': this.code === 1,
                        'alert alert-danger text-center': this.code === 3
                    }
                };
            },

            messageStatus() {
                if (this.code === 1) {
                    return 'Carregando...';
                } else if (this.code === 3) {
                    return this.message || 'Houve um erro e os resultados não foram carregados';
                }
            }
        }
    }
</script>

<style scoped>

</style>