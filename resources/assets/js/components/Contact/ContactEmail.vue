<template>
    <div class="row">
        <h2 class="contact__section-title">Envie-nos uma mensagem</h2>

        <form id="send-email" class="send-email" action="/contato/enviar" @submit="sendEmail" ref="form">
            <form-mask :show-mask="showFormMask" :fullscreen="formMaskFullscreen" :loader-message="formLoaderMessage"></form-mask>

            <form-message :error="showMessageError" :success="showMessageSuccess" :message="formMessage"></form-message>

            <div class="form-group">
                <label class="control-label">Nome <small class="send-email__required">*</small></label>

                <div class="input-group col-12 col-sm-8 col-md-7">
                    <input id="send-email-name" class="form-control input-lg" :class="contactEmailStyles.fields.name" type="text" name="send-email-name" @keyup="removeErrorStatus" v-model="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">E-mail <small class="send-email__required">*</small></label>

                <div class="input-group col-12 col-sm-9 col-md-9 col-lg-9">
                    <input id="send-email-email"  class="form-control input-lg" :class="contactEmailStyles.fields.email" type="text" name="send-email-email" @keyup="removeErrorStatus" v-model="email">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Assunto <small class="send-email__required">*</small></label>

                <div class="input-group col-8 col-sm-6 col-md-5 col-lg-3">
                    <select id="send-email-subject" class="form-control input-lg" :class="contactEmailStyles.fields.subject" @change="removeErrorStatus" v-model="subject">
                        <option disabled>Selecione o assunto.</option>

                        <option v-for="(subjectValue, subjectKey) in subjects" :value="subjectKey">{{ subjectValue }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-12">
                    <textarea id="send-email-content" class="send-email__content form-control" :class="contactEmailStyles.fields.content" name="send-email-text" @keyup="removeErrorStatus" v-model="content"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-12">
                    <input type="submit" class="send-email__submit btn btn-light" value="Enviar">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import AppMask from '../Base/AppMask';
    import ContactEmailMessages from './ContactEmailMessage';

    export default {
        name: 'contact-email',

        components: {
            'form-mask': AppMask,
            'form-message': ContactEmailMessages
        },

        props: {
            'subjectSelected': {
                type: String,
                default: ''
            }
        },

        data() {
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

                showFormMask: false,
                formMaskFullscreen: true,
                formLoaderMessage: 'Enviando...',

                showMessageError: false,
                showMessageSuccess: false,
                formMessage: '',

                hideSubmitMessage: null,
                defaultScroll: 10
            }
        },

        computed: {
            contactEmailStyles: function() {
                return {
                    fields: {
                        name: {
                            'is-invalid': this.nameError
                        },

                        email: {
                            'is-invalid': this.emailError
                        },

                        subject: {
                            'is-invalid': this.subjectError
                        },

                        content: {
                            'is-invalid': this.contentError
                        }
                    }
                }
            }
        },

        mounted: function() {
            this.defaultScroll += this.$refs.form.offsetTop;

            axios.get('/json/contact')
                .then(response => {
                    this.subjects = response.data.subjects;
                })
                .catch(err => {
                    console.log(err)
                });
        },

        methods: {
            removeErrorStatus(evt) {
                let keyCode = evt.which || evt.keyCode;

                if (keyCode != 13) {
                    let element = evt.target.id.replace('send-email-', '') + 'Error';

                    if (this[element]) {
                        this[element] = false;
                        this.showMessageError = false;
                    }
                }
            },

            resetMessagesDisplay() {
                this.showMessageError = false;
                this.showMessageSuccess = false;
            },

            sendEmail(evt) {
                evt.preventDefault();

                this.resetMessagesDisplay();

                let errorMessages = {
                    name: 'Preencha o campo nome.',
                    email: 'Preencha o campo email.',
                    subject: 'Escolha um assunto.',
                    content: 'Preencha o campo de texto.'
                }

                if (this.name === '') {
                    this.setMessageError(errorMessages.name, 'name');

                } else if (this.email === '') {
                    this.setMessageError(errorMessages.email, 'email');

                }else if (!this.validateEmail()) {
                    this.setMessageError('Preencha com um e-mail válido.', 'email');

                } else if (this.subject === '') {
                    this.setMessageError(errorMessages.subject, 'subject');

                } else if (this.content === '') {
                    this.setMessageError(errorMessages.content, 'content');

                } else {
                    this.showFormMask = true;

                    this.scrollWindow(800);

                    let data = {
                        name: this.name,
                        email: this.email,
                        subject: this.subjects[this.subject],
                        content: this.content
                    };

                    axios.post('/contato/enviar', data)
                        .then(response => {

                            this.showFormMask = false;
                            this.setMessageSuccess(response.data, true);
                        })
                        .catch(err => {
                            console.log(err);

                            this.showFormMask = false;

                            if (err.response.status === 422) { // error response form Laravel
                                for (let field in err.response.data) {
                                    this.setMessageError(errorMessages[field], field);
                                }
                            } else {
                                this.setMessageError('Houve um erro no envio do e-mail.', true);
                            }
                        });

                    this.hideSubmitMessage = setTimeout(() => {
                        this.resetMessagesDisplay()
                    }, 3000);
                }
            },

            setMessageContent(message, targetElement, submitMessage) {
                if (typeof targetElement === 'boolean') {
                    submitMessage = targetElement;
                    targetElement = null;
                }

                if (!submitMessage) {
                    clearTimeout(this.hideSubmitMessage);
                }

                this.formMessage = message;

                if (targetElement) {
                    let elementError = targetElement + 'Error';
                    let selector = '#send-email-' + targetElement;

                    this[elementError] = true;
                    $(selector).focus();
                }

                this.scrollWindow();
            },

            setMessageError(message, targetElement, submitMessage) {

                this.showMessageSuccess = false;
                this.showMessageError = true;

                this.setMessageContent(message, targetElement, submitMessage);
            },

            setMessageSuccess(message, targetElement, submitMessage) {
                this.showMessageError = false;
                this.showMessageSuccess = true;

                this.setMessageContent(message, targetElement, submitMessage);
            },

            scrollWindow(speed, scrollTo) {
                speed = speed || 500;
                scrollTo = scrollTo || this.defaultScroll;

                $('html, body').animate({scrollTop: scrollTo}, speed);
            },

            validateEmail() {
                return /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.email);
            }
        }
    }
</script>
