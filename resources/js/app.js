import ListAirTicketComponent from "./components/cosmosHoliday/air-ticket/ListAirTicketComponent";

require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from "./routers";
import Vuex from 'vuex'
Vue.use(Vuex)

import VueSession from 'vue-session'
Vue.use(VueSession)

// import Multiselect from 'vue-multiselect'
//
// // register globally
// Vue.component('multiselect', Multiselect)




// dynamic vue select start
// import DynamicSelect from 'vue-dynamic-select'
// Vue.use(DynamicSelect)
// dynamic vue selet end

//vue-select Start
// import vSelect from 'vue-select'
// Vue.component('v-select', vSelect)
// import 'vue-select/dist/vue-select.css';
//vue-select end

import VeeValidate from "vee-validate"
Vue.use(VeeValidate)
import storeData from './store/index'
const store = new Vuex.Store(storeData)
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/cosmosHoliday/MasterComponent').default);
Vue.component('footer-component', require('./components/cosmosHoliday/includes/FooterComponent').default);
Vue.component('sidebar-component', require('./components/cosmosHoliday/includes/SidebarComponent').default);
Vue.component('pagination', require('./components/cosmosHoliday/partial/PaginationComponent').default);

// Vue.component('pagination', require('laravel-vue-pagination'));
// moment js
import {filters} from './filters'
// v-form
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form
//Sweet Alert 2
import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})
window.Toast = Toast
// DynamicSelect Start
import DynamicSelect from 'vue-dynamic-select'

Vue.use(DynamicSelect)
// DynamicSelect End

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode:'history'
})
const app = new Vue({
    el: '#app',
    router,
    store
})
