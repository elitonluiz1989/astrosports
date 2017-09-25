<template>
    <div class="row">
        <h2 class="contact__section-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Envie-nos uma mensagem</h2>

        <form class="send-email col-xs-12 col-lg-9 col-lg-offset-1" action="/contato/enviar" v-on:submit="sendEmail">
            <div class="form-group send-email__message" v-bind:class="contactEmailStyles.message.show">
                <p class="alert" v-bind:class="[ contactEmailStyles.message.error, contactEmailStyles.message.success ]">{{
                    formMessage }}</p>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 col-md-3 col-lg-2">Nome <small class="send-email__required">*</small></label>

                <div class="input-group col-xs-12 col-sm-8 col-md-7" v-bind:class="contactEmailStyles.fields.name">
                    <input id="send-email-name" class="form-control input-lg" type="text" name="send-email-name" v-on:keyup="removeErrorStatus" v-model="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 col-md-3 col-lg-2">E-mail <small class="send-email__required">*</small></label>

                <div class="input-group col-xs-12 col-sm-9 col-md-9 col-lg-9" v-bind:class="contactEmailStyles.fields.email">
                    <input id="send-email-email"  class="form-control input-lg" type="text" name="send-email-email" v-on:keyup="removeErrorStatus" v-model="email">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 col-md-3 col-lg-2">Assunto <small class="send-email__required">*</small></label>

                <div class="input-group col-xs-12 col-sm-6 col-md-5 col-lg-3" v-bind:class="contactEmailStyles.fields.subject">
                    <select id="send-email-subject" class="form-control input-lg" v-on:change="removeErrorStatus" v-model="subject">
                        <option disabled>Selecione o assunto.</option>

                        <option v-for="(value, key) in subjects" v-bind:value="key">{{ value }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group" v-bind:class="contactEmailStyles.fields.content">
                <textarea id="send-email-content"  class="send-email__content form-control col-xs-12" name="send-email-text" v-on:keyup="removeErrorStatus" v-model="content"></textarea>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="submit" class="send-email__submit btn btn-default" value="Enviar">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['subjectSelected'],

        data: function() {
            return {
                name: '',
                nameError: false,

                email: '',
                emailError: false,

                subjects: [],
                subject: this.subjectSelected,
                subjectError: false,

                content: '',
                contentError: false,

                showMessageError: false,
                showMessageSuccess: false,
                formMessage: ''
            }
        },

        mounted: function() {
            axios.get('/json/contact')
                .then(response => {
                    this.subjects = response.data.subjects;
                })
                .catch(err => {
                    console.log(err)
                });
        },

        computed: {
            contactEmailStyles: function() {
                return {
                    message: {
                        show: {
                            'send-email__message--show': this.showMessageError || this.showMessageSuccess
                        },

                        error: {
                            'alert-danger': this.showMessageError
                        },

                        success: {
                            'alert-success': this.showMessageSuccess
                        }
                    },

                    fields: {
                        name: {
                            'has-error': this.nameError
                        },

                        email: {
                            'has-error': this.emailError
                        },

                        subject: {
                            'has-error': this.subjectError
                        },

                        content: {
                            'has-error': this.contentError
                        }
                    }
                }
            }
        },

        methods: {
            removeErrorStatus: function(evt) {
                let element = evt.target.id.replace('send-email-', '') + 'Error';

                if (this[element]) {
                    this[element] = false;
                    this.showMessageError = false;
                }
            },

            validateEmail: function() {
                return /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.email);
            },

            sendEmail: function(evt) {
                evt.preventDefault();

                const scrollTo = 300;

                if (this.name == '') {
                    this.showMessageError = true;
                    this.nameError = true;
                    this.formMessage = 'Preencha o campo nome.';
                    document.querySelector('#send-email-name').focus();
                    window.scrollTo(0, scrollTo);

                } else if (this.email == '') {
                    this.showMessageError = true;
                    this.emailError = true;
                    this.formMessage = 'Preencha o campo email.';
                    document.querySelector('#send-email-email').focus();
                    window.scrollTo(0, scrollTo);

                }else if (!this.validateEmail()) {
                    this.showMessageError = true;
                    this.emailError = true;
                    this.formMessage = 'Preencha com um e-mail válido.';
                    document.querySelector('#send-email-email').focus();
                    window.scrollTo(0, scrollTo);

                } else if (this.subject == '') {
                    this.showMessageError = true;
                    this.subjectError = true;
                    this.formMessage = 'Escolha um assunto.';
                    document.querySelector('#send-email-subject').focus();
                    window.scrollTo(0, scrollTo);

                } else if (this.content == '') {
                    this.showMessageError = true;
                    this.contentError = true;
                    this.formMessage = 'Preencha o campo de texto.';
                    document.querySelector('#send-email-content').focus();
                    window.scrollTo(0, scrollTo);

                } else {
                    axios.post('/contato/enviar')
                        .then(response => {
                            this.showMessageSuccess = true;
                            this.formMessage = this.response.message;
                            window.scrollTo(0, scrollTo);
                        })
                        .catch(err => {
                            console.log(err)
                            this.showMessageError = true;
                            this.formMessage = 'Houve um erro e no envio do e-mail';
                            window.scrollTo(0, scrollTo);
                        });
                }
            }
        }
    }
</script>