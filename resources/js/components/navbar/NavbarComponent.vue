<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand">
                BBQ EXPRESS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Delivery de Carnes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" v-show="logged">|</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/home" v-show="logged">Dashboard</a>
                    </li>
                    <li class="nav-item" v-show="supplier || user">
                        <a class="nav-link" href="/orders">Pedidos</a>
                    </li>
                    <li class="nav-item" v-show="admin">
                        <a class="nav-link" href="/products">Produtos</a>
                    </li>
                    <li class="nav-item" v-show="admin">
                        <a class="nav-link" href="/categories">Categorias</a>
                    </li>
                    <li class="nav-item" v-show="admin">
                        <a class="nav-link" href="/users">Usuarios</a>
                    </li>
                    <li class="nav-item" v-show="admin">
                        <a class="nav-link" href="/sectors">Setores</a>
                    </li>
                    <li class="nav-item" v-show="admin || user || supplier">
                        <a class="nav-link" href="/profitability">Rentabilidade</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item" v-show="logged">
                        <a class="nav-link" @click="openCart()">Cart</a>
                    </li>
                    <li class="nav-item" v-show="!logged">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item" v-show="!logged">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                    <li class="nav-item dropdown" v-show="logged">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ user_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                <input type="hidden" name="_token" :value="csrf">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                error: null,
                user_name: null,
                logged: false,
                admin: false,
                supplier: false,
                user: false
            }
        },
        props: {
            csrf: null,
            auth_user: {
                default: null,
                required: false
            }
        },
        beforeMount() {
            if (this.auth_user !== null) {
                const user = JSON.parse(this.auth_user)
                this.user_name = user.name
                this.logged = true
                this.verifyProfiles(user)
            }
        },
        methods: {
            verifyProfiles(user) {
                switch (user.profile_id) {
                    case 1:
                        this.user = true;
                        break;

                    case 2:
                        this.supplier = true;
                        break;

                    case 3:
                        this.admin = true;
                        break;
                }
            },
            async openCart() {
                console.log("openCart")
            }
        }
    }
</script>
