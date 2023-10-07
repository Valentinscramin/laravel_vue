<template>
    <div>
        <div class="banner">
            <div class="container">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-md-6 col-sm-12">
                        <h2>Salve seu churrasco</h2>
                        <small>Ou faça o açougue da semana</small>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-4">
                        <form action="#">
                            <div class="mb-3">
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="Qual é seu endereço ?" aria-describedby="helpId" @click="showModal">
                            </div>
                        </form>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="page">Categoria 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" aria-current="page">Categoria 2</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="display:block;" v-show="isActive">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Onde você quer receber seu pedido? </h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"
                            @click="showModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Rua Exemplo, n23, cidade"
                                aria-label="Endereço" aria-describedby="basic-addon2" v-model="address"
                                v-on:change="searchLocation()">
                            <div class="input-group-append">
                                <button class="btn btn-md btn-primary" v-on:click="geolocation()">icon_locale</button>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success" v-on:click="searchLocation()">Procurar</button>
                        <GmapMap class="mt-2" :center="{ lat: currentLocation.lat, lng: currentLocation.lng }"
                            :zoom="17" :icon="{}" :options="{ disableDefaultUI: true }"
                            map-type-id="terrain" style="width: 100%; height: 300px">
                            <GmapCustomMarker :marker="currentLocation">
                                <img style="width:30px;height:50;" src="https://vuejs.org/images/logo.png" />
                            </GmapCustomMarker>
                        </GmapMap>
                        <hr>
                        <small><a class="btn btn-sm btn-link" href="/login">Click aqui caso já possua uma
                                conta</a></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            @click="showModal">Fechar</button>
                        <a type="button" class="btn btn-primary" href="/register">Confirmar Endereço</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import GmapCustomMarker from 'vue2-gmap-custom-marker'

    export default {
        data() {
            return {
                isActive: false,
                address: '',
                error: null,
                latitude: null,
                longitude: null,
                currentLocation: {
                    lat: 0,
                    lng: 0
                },
            }
        },
        mounted() {
            this.geolocation();
        },
        methods: {
            async showModal() {
                if (!this.isActive) {
                    this.isActive = true;
                } else {
                    this.isActive = false;
                }
            },
            async geolocation() {
                navigator.geolocation.getCurrentPosition((position) => {
                    this.currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                });
            },
            async searchLocation() {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': this.address
                }, (results, status) => {
                    if (status === 'OK') {
                        this.address = results[0].formatted_address;
                        localStorage.address = this.address
                        this.currentLocation.lat = results[0].geometry.location.lat();
                        this.currentLocation.lng = results[0].geometry.location.lng();
                    }
                });
            }
        },
        components: {
            GmapCustomMarker
        }
    }
</script>
<style scoped>
    .banner {
        position: relative;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .banner::before {
        content: '';
        background-image: url('http://127.0.0.1:8000/storage/images/background.jpg');
        background-size: cover;
        background-position: center;
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        opacity: 0.75;
    }

    .container {
        top: 50px;
        position: relative;
        text-align: center;
        background-color: #F8FAFC;
        border-radius: 5px;
        width: 50%;
        box-shadow: 1px 1px 3px black;
    }

    .row {
        /* margin: 10px; */
    }

    .nav {
        justify-content: center;
    }

    .modal {
        top: 10%;
        align-self: center;
    }
</style>
