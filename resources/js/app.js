
require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueRouter from 'vue-router'
import MainRoutes from './routes.js'
import datePicker from 'vue-bootstrap-datetimepicker';
import 'bootstrap/dist/css/bootstrap.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';


Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(datePicker);


const router = new VueRouter({
    routes: MainRoutes
  });

Vue.component('app-div', require('./components/App.vue'));


const app = new Vue({
    el: '#app',
    router
});
