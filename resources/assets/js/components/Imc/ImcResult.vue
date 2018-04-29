<template>
    <div class="imc__result-content">
        <div class="imc__message" :class="imcResultStyles.message" v-if="!hasErrors">
            <div class="imc__message-value" :class="imcResultMessageStyle">{{ imcResultValue }}</div>
            <div class="imc__message-text" :class="imcResultMessageStyle">{{ imcResultMessage }}</div>
            <div class="imc__message-range">Faixa {{ imcResultRangeText }}</div>
        </div>

        <div class="imc__error" :class="imcResultStyles.error" v-if="hasErrors">
            <p class="imc__error-message">{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ImcResult',

        props: {
            imcValue: {
                type: String,
                required: true
            },

            showImcResult: {
                type: Boolean,
                default: false
            }
        },

        data: function() {
            return {
                resultMessages: [],
                errorMessage: [],
                hasErrors: false,
                showImcErrors: false,
                showImcMessage: false,
                imcResultClass: ''
            }
        },

        computed: {
            imcResultStyles: function () {
                return {
                    message: {
                        'imc__message--show': this.showImcMessage
                    },

                    error: {
                        'imc__error--show': this.showImcErrors
                    }
                }
            },

            imcResultValue: function() {
                return this.imcValue.replace('.', ',');
            },

            imcResultRange: function() {
                return this.setImcResultRange();
            },

            imcResultRangeText: function () {
                return (this.resultMessages[this.imcResultRange] != undefined) ? this.resultMessages[this.imcResultRange].range : '';
            },

            imcResultMessageStyle: function() {
                return 'imc__message--' + this.imcResultRange;
            },

            imcResultMessage: function() {
                return (this.resultMessages[this.imcResultRange] != undefined) ? this.resultMessages[this.imcResultRange].message : '';
            }
        },

        watch: {
            showImcResult(show) {
                if (show) {
                    if (this.hasErrors) {
                        this.showImcErrors = true;
                        this.showImcMessage = false;
                    } else {
                        this.showImcErrors = false;
                        this.showImcMessage = true;
                    }
                } else {
                    this.showImcErrors = false;
                    this.showImcMessage = false;
                }
            }
        },

        mounted: function() {
            axios.get('/json/imc')
                .then(response => {
                    this.resultMessages = response.data;
                })
                .catch(err => {
                    console.log(err)
                    this.errorMessage = 'Houve um erro no cálculo do IMC.';
                    this.hasErrors = true;
                });
        },

        methods: {
            setImcResultRange: function() {
                if (this.imcValue <= 17) {
                    return 'very-underweight';
                } else if (this.imcValue > 17 && this.imcValue < 18.5) {
                    return 'underweight';
                } else if (this.imcValue >= 18.5 && this.imcValue < 25) {
                    return 'normal-weight';
                } else if (this.imcValue >= 25 && this.imcValue < 30) {
                    return 'overweight';
                } else if (this.imcValue >= 30 && this.imcValue < 35) {
                    return 'obesity1';
                } else if (this.imcValue >= 35 && this.imcValue < 40) {
                    return 'obesity2';
                } else {
                    return 'obesity3';
                }
            }
        }
    }
</script>