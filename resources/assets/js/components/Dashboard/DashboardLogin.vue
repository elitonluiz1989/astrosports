<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-5">
                <login-mask :show-mask="showMask" fullscreen></login-mask>

                <form class="login container" @submit.prevent.stop="submitLogin" ref="form">
                    <div class="row">
                        <h3 class="login__title col-12">Login</h3>
                    </div>

                    <login-message :show="formMessageShow" :type="formMessageType" :text="formMessageText"></login-message>

                    <div class="form-group row">
                        <label for="login-username" :class="styles.label">Username</label>

                        <div :class="styles.inputGroup">
                            <input type="text" id="login-username" name="login-username" class="form-control" v-model="username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="login-password" :class="styles.label">Senha</label>

                        <div :class="styles.inputGroup">
                            <input type="password" id="login-password" name="login-password"  class="form-control" v-model="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="login-remember" class="login__remember-label control-label col-9 col-sm-10">Lembrar usuário</label>

                        <div class="input-group col-3 col-sm-2">
                            <input type="checkbox" id="login-remember" name="login-remember"  class="form-control" v-model="remember">
                        </div>
                    </div>

                    <div class="login__btn-group row justify-content-around">
                        <button type="reset" class="btn btn-light col-4">Limpar</button>

                        <button type="submit" class="btn btn-success col-4">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginMask from '@components/Base/AppMask';
    import LoginMessage from '@components/Base/FomMessage';
    import FormMessageMixin from '@components/Base/Mixins/FormMessage';

    export default {
        name: "dashboard-login",

        components: {
            LoginMask,
            LoginMessage
        },

        mixins: [
          FormMessageMixin
        ],

        data() {
            return {
                username: '',
                password: '',
                remember: false,

                showMask: false,
            };
        },

        computed: {
            styles() {
                return {
                    label: 'control-label col-12 col-md-3 col-xl-4 text-xl-center',
                    inputGroup: 'col-12 col-md-9 col-xl-8'
                };
            }
        },

        methods: {
            submitLogin() {
                if (this.username === "") {
                    this.showMessageError("Informe o nome de usuário.", this.$refs.form.querySelector('#login-username'));
                } else if (this.password === '') {
                    this.showMessageError("Informe a senha do usuário.", this.$refs.form.querySelector('#login-password'));
                } else {
                    this.showMask = true;
                    this.formMessageShow = false;

                    let data = {
                        username: this.username,
                        password: this.password
                    };

                    if (this.remember) {
                        data.remember = this.remember;
                    }

                    axios.post('/login', data)
                        .then(response => {
                            if (response.data.login) {
                                window.location.href = '/dashboard';
                            } else {
                                this.showMask = false;

                                this.showMessageError("Usuário/senha incorretos.");
                            }
                        })
                        .catch(err => {
                            this.showMask = false;

                            this.showMessageError("Usuário/senha incorretos.");
                        });
                }
            }
        }
    }
</script>