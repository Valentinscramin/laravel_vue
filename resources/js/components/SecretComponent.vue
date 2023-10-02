<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 col-6 offset-3">
                <form action="#" @submit="handleLogin">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId"
                            placeholder="Email" v-model="formData.email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="text" class="form-control" name="password" id="password"
                            aria-describedby="helpId" placeholder="Password" v-model="formData.password">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                secrets: [],
                formData: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            async handleLogin(e) {
                e.preventDefault();

                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', this.formData).then(response => {
                        this.getSecrets()
                    });
                });
            },
            async getSecrets() {
                axios.get('/api/secrets').then(response => {
                    console.log(response);
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
