/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue').default;
import * as VueGoogleMaps from 'vue2-google-maps';
import GmapCustomMarker from 'vue2-gmap-custom-marker';
import VueCookies from 'vue3-cookies';

Vue.use(VueGoogleMaps, {
load: {
key: 'AIzaSyBQKKBGo-3kPnFhSHDH2Q8AOPTQmEaAZKs',
libraries: 'places',
}
});
Vue.use(GmapCustomMarker)

/**
* The following block of code may be used to automatically register your
* Vue components. It will recursively scan this directory for the Vue
* components and automatically register them with their "basename".
*
* Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);
Vue.component('register-component', require('./components/auth/RegisterComponent.vue').default);
Vue.component('navbar-component', require('./components/navbar/NavbarComponent.vue').default);
Vue.component('user-component', require('./components/admin/user/UserComponent.vue').default);
Vue.component('products-component', require('./components/admin/products/ProductsComponent.vue').default);
Vue.component('categories-component', require('./components/admin/categories/CategoriesComponent.vue').default);
Vue.component('guest-component', require('./components/site/guest/GuestComponent.vue').default);
Vue.component('loged-component', require('./components/site/loged/LogedComponent.vue').default);

Vue.component('message-alert-component', require('./components/tools/MessageAlertComponent.vue').default);

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

const app = new Vue({
el: '#app',
});
