<template>
    <div class="imc__result-content">
        <div class="imc__message" v-bind:class="imcResultStyles.message" v-if="!hasErrors">
            <div class="imc__message-value" v-bind:class="imcResultMessageStyle">{{ imcResultValue }}</div>
            <div class="imc__message-text" v-bind:class="imcResultMessageStyle">{{ imcResultMessage }}</div>
            <div class="imc__message-range">Faixa {{ imcResultRangeText }}</div>
        </div>

        <div class="imc__error" v-bind:class="imcResultStyles.error" v-if="hasErrors">
            <p class="imc__error-message" v-for="error of errors">Error: {{ error.message }}</p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['imcValue'],

        data: function() {
            return {
                resultMessages: [],
                errors: [],
                hasErrors: false,
                showImcErrors: false,
                showImcMessage: false,
                imcResultClass: ''
            }
        },

        mounted: function() {
            axios.get('/json/imc')
                .then(response => {
                    this.resultMessages = response.data;
                })
                .catch(err => {
                    this.errors.push(err);
                    this.hasErrors = true;
                });
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
                return String(this.imcValue).replace('.', ',');
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