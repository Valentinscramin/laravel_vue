<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-11">
                <h2>Usuarios</h2>
            </div>
            <div class="col-1">
                <button class="btn btn-primary" @click="newRegister()">Novo</button>
            </div>
        </div>
        <div class="search-wrapper mb-1">
            <input class="form-control" type="text" v-model="filtered" placeholder="Procurar.." />
        </div>
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" v-for="eachone in data" :key="eachone.id">
                            <td>{{ eachone . name }}</td>
                            <td>{{ eachone . email }}</td>
                            <td>{{ eachone . profile_id }}</td>
                            <td><button class="btn btn-light btn-sm" @click="editRegister(eachone)">Editar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <message-alert-component :message="message" v-show="message_show" />
        </div>
        <div class="register-section" v-show="registerShow">
            <h4 class="card-title p-3">{{ section }}</h4>
            <hr class="my-4">
            <form action="#" @submit="saveRegister">
                <div class="m-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="formData.name">
                </div>
                <div class="m-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="formData.email">
                </div>
                <div class="m-3">

                    <label for="" class="form-label">Perfil</label>
                    <select class="form-select form-select-lg" name="profile" id="profile"
                        v-model="formData.profile_id">
                        <option selected :value="null">Selecione um perfil</option>
                        <option v-for="eachone in profiles" :key="eachone.id" :value="eachone.id">
                            {{ eachone . name }}</option>
                    </select>
                </div>
                <div class="m-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="formData.password">
                </div>
                <div class="m-3">
                    <label for="active" class="form-label">Ativo</label>
                    <select class="form-control" name="active" id="active" v-model="formData.active">
                        <option value="1">Ativo</option>
                        <option value="0">Não ativo</option>
                    </select>
                </div>
                <div class="m-3 pb-3">
                    <button class="btn btn-md btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                error: null,
                section: null,
                data: null,
                data_backup: null,
                registerShow: false,
                profiles: [],
                message_show: false,
                message: {
                    message_status: null,
                    message_header: null,
                    message_body: null
                },
                formData: {
                    id: null,
                    name: null,
                    email: null,
                    profile_id: null,
                    password: null,
                    active: null,
                },
                filtered: ''
            }
        },
        mounted() {
            this.getAll()
        },
        methods: {
            async editRegister(selected) {
                this.section = "Editar"
                this.registerShow = true
                // input elements
                this.formData.id = selected.id
                this.formData.name = selected.name
                this.formData.email = selected.email
                this.formData.profile_id = selected.profile_id
                this.formData.password = selected.password
                this.formData.active = selected.active
                this.getProfiles()
            },
            async newRegister() {
                this.section = "Novo"
                this.registerShow = true
                // input elements
                this.cleanInputs()
                this.getProfiles()
            },
            async saveRegister(e) {
                e.preventDefault();

                let url = 'api/user-store'
                if (this.formData.id !== null) {
                    url = 'api/user-update'
                }

                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post(url, this.formData).then(response => {
                        console.log(response)
                        this.alert(response.status)
                    });
                });

                this.getAll()
                this.registerShow = false
            },
            async getProfiles() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('api/profiles', this.formData).then(response => {
                        this.profiles = response.data
                    });
                });
            },
            async getAll() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('api/user-all', this.formData).then(response => {
                        this.data = response.data
                        this.data_backup = this.data
                    });
                });
            },
            cleanInputs() {
                this.formData.id = null
                this.formData.name = null
                this.formData.email = null
                this.formData.profile_id = null
                this.password = null
                this.formData.active = null
            },
            alert(status) {

                this.message_show = true

                if (status === 200) {
                    this.message.status = "alert alert-success"
                    this.message.message_header = "Registro salvo com sucesso"
                    this.message.message_body = ""
                } else {
                    this.message.status = "alert alert-warning"
                    this.message.message_header = "Falha"
                    this.message.message_body = "ao salvar Registro"
                }

                setTimeout(() => this.message_show = false, 5000);

            }
        },
        watch: {
            filtered: function(val) {

                if (val.length > 0) {
                    this.data = this.data_backup
                    return this.data.filter(data => {
                        if (data.name.toLowerCase().includes(val.toLowerCase())) {
                            this.data = Array(JSON.parse(JSON.stringify(data)));
                        }
                        if (data.email.toLowerCase().includes(val.toLowerCase())) {
                            this.data = Array(JSON.parse(JSON.stringify(data)));
                        }
                    })
                } else {
                    this.data = this.data_backup
                }
            }
        }
    }
</script>

<style scoped>
    .register-section {
        box-shadow: 0.5px 0.5px 5px black;
        background-color: white;
        border-radius: 5px;
    }

    table {
        max-height: 100px !important;
    }
</style>
