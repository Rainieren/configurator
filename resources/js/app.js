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
import Vue2Filters from 'vue2-filters'
import Vuelidate from 'vuelidate';
import Flash from './components/FlashComponent.vue';
import Modal from './components/steps/modalComponent.vue';

import Configurator from "./pages/Configurator.vue";
import CreateConfiguratorForm from "./components/configurators/createConfiguratorForm.vue";
import ChooseConfigurator from "./components/configurators/chooseConfiguratorComponent.vue";
import ConfiguratorLoadingScreen from "./components/configurators/configuratorLoadingScreenComponent.vue";
import EditConfiguratorForm from "./components/configurators/editConfiguratorForm.vue";
import ConfigurationModal from "./components/configurators/configurationModal.vue";

import CreateProductForm from "./components/products/createProductForm.vue";
import ProductModal from "./components/products/productModal.vue";
import EditProductForm from "./components/products/editProductForm.vue";
import ConfigurableProduct from "./components/products/configurableProductsComponent.vue";

import CreateStepForm from "./components/steps/createStepForm.vue";
import EditStepForm from "./components/steps/editStepForm.vue";
import StepList from "./components/steps/stepsComponent.vue"

import Statistics from "./components/dashboard/statisticsComponent.vue";
import Summary from "./components/summary/summaryComponent.vue";
import UploadedFiles from './components/imageUpload/uploadedFileComponent.vue'

import CreateManufacturerForm from "./components/manufacturers/createManufacturerForm.vue";
import EditManufacturerForm from "./components/manufacturers/editManufacturerForm.vue";


let Vue2FiltersConfig = {
    percent: {
        decimalDigits: 2,
        multiplier: 100,
        decimalSeparator: '.'
    },
}

Vue.use(VueMask);
Vue.use(Vuelidate);
Vue.use(Vue2Filters, Vue2FiltersConfig)





Vue.component('flash', require('./components/FlashComponent.vue').default);
Vue.component('statistics', require('./components/dashboard/statisticsComponent.vue').default);
// Vue.component('modal', require('./components/modalComponent.vue').default);

// Product
Vue.component('product-create-form', require('./components/products/createProductForm.vue').default);
Vue.component('product-modal', require('./components/products/productModal.vue').default);
Vue.component('product-edit-form', require('./components/products/editProductForm.vue').default);
Vue.component('product-preview', require('./components/products/productPreview').default)
Vue.component('card-preview', require('./components/products/cardPreview').default)
Vue.component('radio-preview', require('./components/products/radioPreview.vue').default)
Vue.component('configurable-product', require('./components/products/configurableProductsComponent.vue').default)

// Steps
Vue.component('step-create-form', require('./components/steps/createStepForm.vue').default);
Vue.component('step-edit-form', require('./components/steps/editStepForm.vue').default);
Vue.component('step-list', require('./components/steps/stepsComponent.vue').default);


Vue.component('manufacturer-create-form', require('./components/manufacturers/createManufacturerForm.vue').default)
Vue.component('manufacturer-edit-form', require('./components/manufacturers/editManufacturerForm.vue').default)

Vue.component('configurator-create-form', require('./components/configurators/createConfiguratorForm.vue').default)
Vue.component('configurator-edit-form', require('./components/configurators/editConfiguratorForm.vue').default)
Vue.component('choose-configurator', require('./components/configurators/chooseConfiguratorComponent.vue').default)
Vue.component('configurator-loading-screen', require('./components/configurators/configuratorLoadingScreenComponent.vue').default)


// Pages
Vue.component('configurator-view', require('./pages/Configurator.vue').default);

// Configurator
Vue.component('configurator', require('./components/ConfiguratorComponent.vue').default)
Vue.component('summary', require('./components/summary/summaryComponent.vue').default)

Vue.component('uploaded-files', require('./components/imageUpload/uploadedFileComponent.vue').default)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        Configurator,
        Summary,
        ConfigurationModal,
        ChooseConfigurator,
        ConfiguratorLoadingScreen,
        ProductModal,
        ConfigurableProduct
    }
});

const dashboard = new Vue({
    el: '#dashboard',
    components: {
        Flash,
        Modal,
        CreateProductForm,
        EditProductForm,
        CreateStepForm,
        EditStepForm,
        Statistics,
        CreateManufacturerForm,
        EditManufacturerForm,
        StepList,
        CreateConfiguratorForm,
        EditConfiguratorForm,
        UploadedFiles
    }
});
