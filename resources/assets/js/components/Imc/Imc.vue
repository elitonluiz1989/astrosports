<template>
    <div class="sidebar__assessments sidebar-left__wrapper">
        <h2 class="sidebar__assessments-title">Avaliações</h2>

        <div id="imc" class="imc form-horizontal">
            <h3 class="imc__title">IMC</h3>

            <div class="imc_info imc__wrapper">
                <button id="imc-show-info" class="imc__info-btn btn" v-on:click="toggleImcInfo">O que é o IMC? Clique para saber mais.</button>
                <div class="imc__info-content" v-bind:class="{'imc__info--show': showImcInfo}">
                    <p class="imc__text">IMC é a sigla para Índice de Massa Corporal, que é uma medida utilizada para medir a obesidade.</p>
                    <p class="imc__text">O cálculo é feito dividindo o peso (em quilogramas) pela altura (em metros) ao quadrado.</p>
                    <p class="imc__text">IMC pode apresentar alterações, dependendo de fatores como a prática de exercícios físicos.</p>
                </div>
            </div>

            <div class=" imc__wrapper container">
                <div class="form-group row">
                    <label class="col-sm-3 control-label" for="imc__weight">Peso</label>
                    <div class="col-sm-9">
                        <input id="imc__weight" class="form-control input-lg" name="imc__weight" type="text" placeholder="0" v-model="imcWeight" v-on:focus="$event.target.select()" v-on:keypress="allowOnlyNumbers">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label" for="imc__height">Altura</label>
                    <div class="col-sm-9">
                        <input id="imc__height"  class="form-control input-lg" name="imc__height" type="text" placeholder="0" v-model="imcHeight" v-on:focus="$event.target.select()" v-on:keypress="allowOnlyNumbers">
                    </div>
                </div>

                <button class="imc__calculate" v-on:click="calculateImc">Calcular</button>

                <div class="imc__result" v-bind:class="imcStyles.result">
                    <imc-loader :show="imcTransitions.loader.show" :hide="imcTransitions.loader.hide" :floating="false" :message="'Carregando...'"></imc-loader>

                    <imc-result :imc-value="imcValue" :show-imc-result="showImcResult"></imc-result>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TheLoader from '../Base/AppLoader';
    import ImcResult from './ImcResult.vue';

    export default {
        name: 'Imc',

        components: {
            'imc-loader': TheLoader,
            'imc-result': ImcResult
        },

        data: function() {
            return {
                imcWeight: '',
                imcHeight: '',
                imcValue: '',
                showImcInfo: false,
                showImcResult: false,
                initialDelay: 0,
                imcTransitions: {
                    loader: {
                        expand: false,
                        show: false,
                        hide: false
                    },

                    message: {
                        expand: false,
                    }
                }
            }
        },

        computed: {
            imcStyles: function () {
                return {
                    result: {
                        'imc__result--loading-expand': this.imcTransitions.loader.expand,
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

            initialTransitions: function() {
                if (this.initialDelay > 0) {
                    setTimeout(() => {
                        this.setInitialTransitionsValues();
                    }, this.initialDelay);
                } else {
                    this.setInitialTransitionsValues()
                }
            },

            resetTransitions: function () {
                if (this.imcTransitions.message.expand) {
                    this.imcTransitions.message.expand = false;
                    this.showImcResult = false;

                    setTimeout(() => {
                        this.imcTransitions.loader.hide = false;
                    }, 800);

                    this.initialDelay = 1000;
                }
            },

            secondTransitions: function() {
                let transitionDelay = this.initialDelay > 0 ? this.initialDelay + 1000 : 1000;
                setTimeout(() => {
                    this.imcTransitions.loader.show = false;
                }, transitionDelay);

                setTimeout(() => {
                    this.imcTransitions.loader.hide = true;

                    this.imcTransitions.message.expand = true;
                }, transitionDelay + 1000);

                setTimeout(() => {
                    this.imcTransitions.loader.hide = true;

                    this.showImcResult = true;
                }, transitionDelay + 1500);
            },

            setInitialTransitionsValues: function () {
                this.imcTransitions.loader.expand = true;
                this.imcTransitions.loader.show = true;
            },

            validateImcInput: function(input) {
                if (typeof input == 'string' && input.indexOf(',') != -1) {
                    input = parseFloat(input.replace(',', '.'));
                }

                return input;
            },

            toggleImcInfo: function() {
                this.showImcInfo = !this.showImcInfo;
            }
        }
    }
</script>