/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


// import createApp from "vue";
// import Vue from "vue";


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import VueMask from 'v-mask';
import Vuelidate from 'vuelidate';
import Flash from './components/FlashComponent.vue';
import Modal from './components/steps/modalComponent.vue';
import Configurator from "./pages/Configurator.vue";
import CreateProductForm from "./components/products/createProductForm.vue";
import CreateStepForm from "./components/steps/createStepForm.vue";
import Statistics from "./components/dashboard/statisticsComponent.vue";

Vue.use(VueMask);
Vue.use(Vuelidate);


Vue.component('configurator', require('./components/ConfiguratorComponent.vue').default)
Vue.component('flash', require('./components/FlashComponent.vue').default);
Vue.component('statistics', require('./components/dashboard/statisticsComponent.vue').default);
// Vue.component('modal', require('./components/modalComponent.vue').default);

// Product
Vue.component('product-create-form', require('./components/products/createProductForm.vue').default);
Vue.component('product-preview', require('./components/products/productPreview').default)
Vue.component('card-preview', require('./components/products/cardPreview').default)
Vue.component('radio-preview', require('./components/products/radioPreview.vue').default)

// Steps
Vue.component('step-create-form', require('./components/steps/createStepForm.vue').default);


// Pages
Vue.component('configurator-view', require('./pages/Configurator.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        Configurator
    }
});

const dashboard = new Vue({
    el: '#dashboard',
    components: {
        Flash,
        Modal,
        CreateProductForm,
        CreateStepForm,
        Statistics
    }
});
