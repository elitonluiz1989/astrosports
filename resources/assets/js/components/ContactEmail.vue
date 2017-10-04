<template>
    <div class="row">
        <h2 class="contact__section-title col-xs-12 col-sm-7 col-md-6 col-lg-4">Envie-nos uma mensagem</h2>

        <form class="send-email col-xs-12 col-lg-9 col-lg-offset-1" action="/contato/enviar" v-on:submit="sendEmail">
            <form-mask :show-mask="showFormMask" :mask-style="dark" :fullscreen="formMaskFullscreen" :loader-message="formLoaderMessage"></form-mask>

            <div class="form-group send-email__message" v-bind:class="contactEmailStyles.message.show">
                <p class="alert" v-bind:class="[ contactEmailStyles.message.error, contactEmailStyles.message.success ]">{{ formMessage }}</p>
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

                        <option v-for="(subjectValue, subjectKey) in subjects" :value="subjectKey">{{ subjectValue }}</option>
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
    import Mask from './Mask';

    export default {
        name: 'contact-email',

        props: ['subjectSelected'],

        data() {
            return {
                name: 'Eliton',
                nameError: false,

                email: 'teste@gmail.com',
                emailError: false,

                subjects: [],
                subject: this.subjectSelected,
                subjectError: false,

                content: 'Isso é um teste!',
                contentError: false,

                showFormMask: false,
                formMaskFullscreen: true,
                formLoaderMessage: 'Enviando...',

                showMessageError: false,
                showMessageSuccess: false,
                formMessage: ''
            }
        },

        components: {
          'form-mask': Mask
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
            scrollWindow(speed, scrollTo) {
                speed = speed || 800;
                scrollTo = scrollTo || 400;

                console.log(speed + ' ' + scrollTo)

                $('html, body').animate({scrollTop: scrollTo}, speed);
            },

            setMessageContent(message, targetElement) {
                this.formMessage = message;

                if (targetElement) {
                    let elementError = targetElement + 'Error';
                    let selector = '#send-email-' + targetElement;

                    this[elementError] = true;
                    $(selector).focus();
                }

                this.scrollWindow(500);
            },

            setMessageError(message, targetElement) {
                this.showMessageSuccess = false;
                this.showMessageError = true;

                this.setMessageContent(message, targetElement);
            },

            setMessageSuccess(message, targetElement) {
                this.showMessageError = false;
                this.showMessageSuccess = true;

                this.setMessageContent(message, targetElement);
            },

            removeErrorStatus(evt) {
                let element = evt.target.id.replace('send-email-', '') + 'Error';

                if (this[element]) {
                    this[element] = false;
                    this.showMessageError = false;
                }
            },

            validateEmail() {
                return /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.email);
            },

            sendEmail(evt) {
                evt.preventDefault();

                if (this.name == '') {
                    this.setMessageError('Preencha o campo nome.', 'name');

                } else if (this.email == '') {
                    this.setMessageError('Preencha o campo email.', 'email');

                }else if (!this.validateEmail()) {
                    this.setMessageError('Preencha com um e-mails válido.', 'email');

                } else if (this.subject == '') {
                    this.setMessageError('Escolha um assunto.', 'subject');

                } else if (this.content == '') {
                    this.setMessageError('Preencha o campo de texto.', 'content');

                } else {
                    this.showFormMask = true;

                    this.scrollWindow();

                    let data = {
                        name: this.name,
                        email: this.email,
                        subject: this.subjects[this.subject],
                        content: this.content
                    };

                    setTimeout(() => {
                    axios.post('/contato/envar', data)
                        .then(response => {
                            console.log(response)

                            this.showFormMask = false;
                            this.setMessageSuccess(response.data);
                        })
                        .catch(err => {
                            console.log(err);

                            this.showFormMask = false;
                            this.setMessageError('Houve um erro e no envio do e-mails');
                        });
                    }, 1000);
                }
            }
        }
    }
</script>
