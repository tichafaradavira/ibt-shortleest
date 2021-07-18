require('./bootstrap');
// window.Vue = require('vue');
import Vue from 'vue'
// import Vuetify from './vuetify'
import Router from './router';
import Example from './components/ExampleComponent'
import ApiService from './plugins/apiService'
import Validation from './plugins/errorHandling'
import { store } from './store/store';
import App from './components/App.vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


Vue.use(Validation);
// Vue.use(VueRouter);
Vue.use(ApiService);

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


Vue.config.productionTip = false

Vue.use(Vuetify)
export default new Vuetify({})


const app = new Vue({
    el: '#app',
    router: Router,
    vuetify: new Vuetify(),
    store,
    components:{
        'app': App
    }
});
