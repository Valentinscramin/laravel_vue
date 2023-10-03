<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-6">
                <h2>Usuarios</h2>
            </div>
            <div class="col-6">
                <button class="btn btn-primary" @click="newRegister()">Novo</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" v-for="eachone in data" :key="eachone.id">
                            <td>{{ eachone . name }}</td>
                            <td>{{ eachone . profile_id }}</td>
                            <td><button class="btn btn-light btn-sm" @click="editRegister(eachone)">Editar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="register-section" v-show="registerShow">
            <h4 class="card-title p-3">{{ section }}</h4>
            <hr class="my-4">
            <form action="#">
                <div class="m-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="name">
                </div>
                <div class="m-3">

                    <label for="" class="form-label">Perfil</label>
                    <select class="form-select form-select-lg" name="profile" id="profile">
                        <option selected :value="null">Selecione um perfil</option>
                        <option v-for="eachone in profiles" :key="eachone.id" :value="eachone.id">
                            {{ eachone . name }}</option>
                    </select>
                </div>
                <div class="m-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="password">
                </div>
                <div class="m-3">
                    <label for="active" class="form-label">Ativo</label>
                    <input type="text" name="active" id="active" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="active">
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
                name: null,
                profiles: [],
                profile_id: null,
                password: null,
                active: null,
                registerShow: false
            }
        },
        props: {
            recived_props: {
                required: true,
                trype: JSON
            }
        },
        beforeMount() {
            this.data = JSON.parse(this.recived_props)
        },
        methods: {
            async editRegister(selected) {
                this.section = "Editar"
                this.name = selected.name
                this.profile_id = selected.profile_id
                this.password = selected.password
                this.active = selected.active
                this.registerShow = true
                this.getProfiles()
            },
            async newRegister() {
                this.section = "Novo"
                this.registerShow = true
                this.cleanInputs()
            },
            async getProfiles() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('api/profiles', this.formData).then(response => {
                        this.profiles = response.data
                    });
                });
            },
            cleanInputs()
            {
                this.name = null
                this.profile_id = null
                this.password = null
                this.active = null
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
</style>
