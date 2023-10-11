<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-11">
                <h2>Produtos</h2>
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
                            <th scope="col">Preço</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ativo</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" v-for="eachone in data" :key="eachone.id">
                            <td>{{ eachone . name }}</td>
                            <td>{{ eachone . price }}</td>
                            <td>{{ eachone . weight }}</td>
                            <td>{{ eachone . categories . name }}</td>
                            <td>{{ eachone . active }}</td>
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
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                        v-model="formData.description"></textarea>
                </div>
                <div class="m-3">
                    <label for="price" class="form-label">Preço</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="formData.price" min="0" max="1000" step="0.01">
                </div>
                <div class="m-3">
                    <label for="weight" class="form-label">Peso</label>
                    <input type="number" name="weight" id="wight" class="form-control" placeholder=""
                        aria-describedby="helpId" v-model="formData.weight" min="0" max="1000"
                        step="0.01">
                </div>
                <div class="m-3">
                    <label for="categories" class="form-label">Categoria</label>
                    <select class="form-select form-select-lg" name="categories" id="profile"
                        v-model="formData.categories_id">
                        <option v-for="eachone in categories" :key="eachone.id" :value="eachone.id">
                            {{ eachone . name }}</option>
                    </select>
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
                categories: [],
                message_show: false,
                message: {
                    message_status: null,
                    message_header: null,
                    message_body: null
                },
                formData: {
                    id: null,
                    name: null,
                    description: null,
                    price: null,
                    weight: null,
                    categories_id: null,
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
                this.formData.description = selected.description
                this.formData.price = selected.price
                this.formData.weight = selected.weight
                this.formData.categories_id = selected.categories_id
                this.formData.active = selected.active
                this.getCategories()
            },
            async newRegister() {
                this.section = "Novo"
                this.registerShow = true
                // input elements
                this.cleanInputs()
                this.getCategories()
            },
            async saveRegister(e) {
                e.preventDefault();

                let url = 'api/products/store'
                if (this.formData.id !== null) {
                    url = 'api/products/' + this.formData.id + '/update'
                }
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post(url, this.formData).then(response => {
                        this.alert(response.status)
                    });
                });

                this.getAll()
                this.registerShow = false
            },
            async getCategories() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('api/categories/all', this.formData).then(response => {
                        this.categories = response.data
                    });
                });
            },
            async getAll() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('api/products/all', this.formData).then(response => {
                        this.data = response.data
                        this.data_backup = this.data
                    });
                });
            },
            cleanInputs() {
                this.formData.id = null
                this.formData.name = null
                this.formData.description = null
                this.formData.price = null
                this.formData.weight = null
                this.formData.categories_id = null
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
