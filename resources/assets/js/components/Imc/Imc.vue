<template>
    <div class="assessments sidebar--left__wrapper">
        <header class="row">
            <h2 class="assessments__title sibebar__title">Avaliações</h2>
        </header>

        <div id="imc" class="imc form-horizontal">
            <h3 class="imc__title">IMC</h3>

            <div class="imc_info imc__wrapper">
                <button id="imc-show-info" class="imc__info-btn" v-on:click="toggleImcInfo">O que é o IMC? Clique para saber mais.</button>
                <div class="imc__info-content" v-bind:class="{'imc__info--show': showImcInfo}">
                    <p class="imc__text">IMC é a sigla para Índice de Massa Corporal, que é uma medida utilizada para medir a obesidade.</p>
                    <p class="imc__text">O cálculo é feito dividindo o peso (em quilogramas) pela altura (em metros) ao quadrado.</p>
                    <p class="imc__text">IMC pode apresentar alterações, dependendo de fatores como a prática de exercícios físicos.</p>
                </div>
            </div>

            <div class=" imc__wrapper">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="imc__weight">Peso</label>
                    <div class="col-sm-9">
                        <input id="imc__weight" class="form-control input-lg" name="imc__weight" type="text" placeholder="0" v-model="imcWeight" v-on:focus="$event.target.select()" v-on:keypress="allowOnlyNumbers">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="imc__height">Altura</label>
                    <div class="col-sm-9">
                        <input id="imc__height"  class="form-control input-lg" name="imc__height" type="text" placeholder="0" v-model="imcHeight" v-on:focus="$event.target.select()" v-on:keypress="allowOnlyNumbers">
                    </div>
                </div>

                <button class="imc__calculate" v-on:click="calculateImc">Calcular</button>

                <div class="imc__result" v-bind:class="imcStyles.result">
                    <div class="imc__loader" v-bind:class="imcStyles.loader">
                        <div class="spinner"></div>
                        <p class="imc__loader-message">Carregando...</p>
                    </div>

                    <imc-result v-bind:imc-value="imcValue"></imc-result>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ImcResult from './ImcResult.vue';

    export default {
        data: function() {
            return {
                imcWeight: '',
                imcHeight: '',
                imcValue: 0,
                showImcInfo: false,
                initialDelay: 0,
                imcTransitions: {
                    loader: {
                        expand: false,
                        show: false,
                        hide: false
                    },

                    error: {
                        expand: false,
                    },

                    message: {
                        expand: false,
                    }
                }
            }
        },

        components: {
            'imc-result': ImcResult
        },

        computed: {
            imcStyles: function () {
                return {
                    result: {
                        'imc__result--loading-expand': this.imcTransitions.loader.expand,
                        'imc__result--errors-reduce': this.imcTransitions.error.expand,
                        'imc__result--message-expand': this.imcTransitions.message.expand
                    },

                    loader: {
                        'imc__loader--show': this.imcTransitions.loader.show,
                        'imc__loader--hide': this.imcTransitions.loader.hide
                    }
                }
            }
        },

        methods: {
            toggleImcInfo: function() {
                this.showImcInfo = !this.showImcInfo;
                console.log('sss')
            },

            validateImcInput: function(input) {
                if (typeof input == 'string' && input.indexOf(',') != -1) {
                    input = parseFloat(input.replace(',', '.'));
                }

                return input;
            },

            allowOnlyNumbers: function(evt) {
                evt = evt ? evt : window.event;
                let keyCode = evt.which || evt.keyCode;

                if ((keyCode > 31 && (keyCode < 48 || keyCode > 57)) && keyCode !== 44 && keyCode !== 46) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },

            calculateImc: function() {
                this.resetTransitions();

                if (this.imcWeight != 0 && this.imcHeight != 0) {

                    this.initialTransitions();

                    let imcWeight = this.validateImcInput(this.imcWeight);
                    let imcHeight = this.validateImcInput(this.imcHeight);

                    let result = imcWeight / (imcHeight * 2);

                    setTimeout(() => {
                        this.imcValue = result.toFixed(2);
                    }, this.initialDelay);

                    this.secondTransitions();
                }
            },

            setInitialTransitionsValues: function () {
                this.imcTransitions.loader.expand = true;
                this.imcTransitions.loader.show = true;
            },

            initialTransitions: function() {
                if (this.initialDelay > 0) {
                    setTimeout(() => {
                        this.setInitialTransitionsValues();
                    }, this.initialDelay);
                } else {
                    this.setInitialTransitionsValues()
                }
            },

            secondTransitions: function() {
                let transitionDelay = this.initialDelay > 0 ? this.initialDelay + 1000 : 1000;
                setTimeout(() => {
                    this.imcTransitions.loader.show = false;
                }, transitionDelay);

                setTimeout(() => {
                    this.imcTransitions.loader.hide = true;

                    if (this.$children[0].hasErrors) {
                        this.imcTransitions.error.expand = this.$children[0].hasErrors;
                    } else {
                        this.imcTransitions.message.expand = true;
                    }
                }, transitionDelay + 1000);

                setTimeout(() => {
                    this.imcTransitions.loader.hide = true;

                    if (this.$children[0].hasErrors) {
                        this.$children[0].showImcErrors = this.$children[0].hasErrors;
                    } else {
                        this.$children[0].showImcMessage = true;
                    }
                }, transitionDelay + 1500);
            },

            resetTransitions: function () {
                if (this.imcTransitions.error.expand || this.imcTransitions.message.expand) {
                    this.imcTransitions.error.expand = false;
                    this.$children[0].showImcErrors = false;

                    this.imcTransitions.message.expand = false;
                    this.$children[0].showImcMessage = false;

                    setTimeout(() => {
                        this.imcTransitions.loader.hide = false;
                    }, 800);

                    this.initialDelay = 1000;
                }
            }
        }
    }
</script>