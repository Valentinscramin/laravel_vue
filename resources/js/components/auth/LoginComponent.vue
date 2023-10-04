<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="#" @submit="handleLogin">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="" required v-model="formData.email">
                                    <small class="text-danger" v-show="email_error">{{ email_error }}</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="current-password" v-model="formData.password">
                                    <small class="text-danger" v-show="password_error">{{ password_error }}</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Lembrar Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a class="btn btn-link" href="password.request">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email_error: null,
                password_error: null,
                formData: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            async handleLogin(e) {
                e.preventDefault();
                console.log(this.formData)
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', this.formData).then(response => {
                        console.log(response)
                        window.location.href = '/home'
                    }).catch(error => {
                        this.setError(error.response.data.errors)
                    });
                });
            },
            async setError(param) {
                if (typeof param.email !== 'undefined') {
                    this.email_error = param.email[0];
                    setTimeout(() => this.email_error = '', 5000);
                }
                if (typeof param.password_error !== 'undefined') {
                    this.password_error = param.password_error[0];

                    setTimeout(() => this.password_error = '', 5000);
                }
            }
        }
    }
</script>
