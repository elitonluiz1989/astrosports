<template>
    <div class="row justify-content-center" v-show="show">
        <div class="col-12 col-lg-10">
            <div class="alert" :class="styles.alert">
                <div class="text-center" v-for="message in messageStatus" v-text="message"></div>
            </div>
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
                type: String|Array,
                default: "Houve um erro e os resultados não foram carregados"
            }
        },

        data() {
            return {
                defaultMessage: "Houve um erro e os resultados não foram carregados"
            }
        },

        computed: {
            show() {
              return this.code === 1 || this.code === 3;
            },

            styles() {
                return {
                    alert: {
                        "alert-warning": this.code === 1,
                        "alert-danger": this.code === 3
                    }
                };
            },

            messageStatus() {
                if (this.code === 1) {
                    return ['Carregando...'];
                } else if (this.code === 3) {
                    if (this.isArray(this.message)) {
                        let messages = this.cleanArray(this.message);

                        if (messages.length > 0) {
                            return messages;
                        } else {
                            return [this.defaultMessage];
                        }
                    }

                    return [this.message];
                }
            }
        }
    }
</script>