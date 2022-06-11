/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

require('./bootstrap');


window.Vue = require('vue').default;
// Require Vue
window.Vue = require('vue').default;
import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)



//Moment js
import moment from 'moment'
// window.moment = moment;
Vue.prototype.moment = moment

//Sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});

window.Toast = Toast;

import axios from 'axios'

Vue.prototype.axios = axios

let Fire = new Vue()
window.Fire = Fire;

Vue.component('order-component', require('./components/OrderComponent.vue').default);
Vue.component('customers-component', require('./components/CustomersComponent.vue').default);
Vue.component('fleet-component', require('./components/FleetComponent.vue').default);



const app = new Vue({
    el: '#app',
});
