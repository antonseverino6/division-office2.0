/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import $ from 'jquery';
// window.$ = window.jQuery = $;

window.Vue = require('vue');
window.Fire = new Vue();

import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

import ToggleButton from 'vue-js-toggle-button'

Vue.use(ToggleButton)


window.Toast = Toast;  

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
    })
    
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import flatpickr from "flatpickr";
window.flatpickr = flatpickr


import moment from 'moment';
Vue.filter('myDate', function(date) {
    return moment(date).format('MMMM DD, YYYY')
  });


import Router from 'vue-router'

Vue.use(Router);

import User from './components/UserComponent.vue';
import Dashboard from './components/DashboardComponent.vue';
import Representative from './components/RepresentativeComponent.vue';
import Subject from './components/Subject/SubjectComponent.vue';
import TypeOfEmployee from './components/TypeOfEmployee/TypeOfEmployeeComponent.vue';
import AddEmployee from './components/AddEmployeeComponent.vue';
import CivilStatus from './components/CivilStatusComponent.vue';
import UserProfile from './components/UserProfile/UserProfileComponent.vue';
import SaveProfile from './components/saveProfileComponent.vue';
import SaveMoreDetails from './components/UserProfile/SaveMoreDetailsComponent.vue';

export const routes = [
    { path: '/users', component: User, name: 'User' },
    { path: '/dashboard', component: Dashboard, name: 'Dashboard' },
    { path: '/represents', component: Representative, name: 'Representative' },
    { path: '/subjects', component: Subject, name: 'Subject' },
    { path: '/add-employee', component: AddEmployee, name: 'AddEmployee' },
    { path: '/type-of-employee', component: TypeOfEmployee, name: 'TypeOfEmployee' },
    { path: '/civil-status', component: CivilStatus, name: 'CivilStatus' },
    { path: '/user-profile', component: UserProfile, name: 'UserProfile' },
    { path: '/save-profile', component: SaveProfile, name: 'SaveProfile' },
    { path: '/save-more-details', component: SaveMoreDetails, name: 'SaveMoreDetails' },
];

const router = new Router({
    mode: 'history',
    routes
});




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
