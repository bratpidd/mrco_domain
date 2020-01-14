
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
Vue.use(VueRouter);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import hello from './components/Hello'
import about from './components/about'
import app from './components/app'
import autocomplete from './components/Autocomplete'
import tag_item from './components/tag_item'

Vue.component('example', require('./components/Example.vue'));
Vue.component('hello', hello);
Vue.component('about', about);
Vue.component('app', app);
Vue.component('autocomplete', autocomplete);
Vue.component('tag_item', tag_item);

const routes = [
    //route for the home route of the web page
    { path: '/vue_retarded', component: hello },
//route for the about route of the web page
    { path: '/vue_retarded/about', component: about },

    { path: '/testpage', component: hello }
];

const router = new VueRouter({
    routes, // short for routes: routes
    mode: 'history'
});

document.addEventListener('DOMContentLoaded', function(){
    const app = new Vue({
        el: '#app_core',

        router
    });
});
