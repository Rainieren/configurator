<template>
    <div class="container-fluid px-0">
        <choose-configurator :configuratorChosen="configuratorChosen" :configurators="configurators" :getConfigurableProducts="getConfigurableProducts"></choose-configurator>
        <configurator-loading-screen v-if="loading"></configurator-loading-screen>


        <div class="flex flex-col xl:flex-row" v-if="!loading">
            <div class="configurator bg-white relative xl:w-8/12 w-full min-h-screen p-10 pt-20 lg:p-20 space-y-15">
                <div class="absolute top-5 left-5 flex justify-center items-center hover:text-indigo-500 bg-white rounded-md shadow-sm px-2 py-1.5 hover:shadow-md transition-all border border-gray-200" v-on:click="configuratorChosen = false, activeProduct = '', chosenOptions = [], steps = [], stepsLoading = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <p class="text-gray-800 font-medium text-sm md:text-base md:text-lg  cursor-pointer hover:text-indigo-500" >Choose a different configurator</p>
                </div>

                <div class="relative flex justify-between items-center pb-4">
                    <h1 class="text-base md:text-lg lg:text-2xl xl:text-3xl font-medium text-gray-900">Configure {{ configurator.name }}</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
<!--                    <configurable-product :active="activeProduct" :options="chosenOptions" :product="product" v-for="product in configurableProducts" :key="product.id" :getAllRelatedSteps="getAllRelatedSteps"></configurable-product>-->
                    <div class="relative" v-for="product in configurableProducts">
                        <button v-bind:key="product.id" type="button" class="bg-white shadow-sm relative min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200 flex flex-column h-100 w-100" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), chosenOptions = [], getAllRelatedSteps(product.id)]" :class="{'border-indigo-500': activeProduct === product, 'pointer-events-none opacity-50': product.stock === 0 || !product.status}">
                            <div class="absolute bg-indigo-500 rounded-full -right-3 -top-3" v-if="activeProduct === product">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="p-3 border-b border-gray-300 h-auto w-100">
                                <div class="flex">
                                    <div class="w-2/3 text-left">
                                        <p class="font-bold text-sm">{{ product.name }}</p>
                                        <p v-if="product.description" class="text-gray-800 text-sm">{{ product.description.substring(0,32) }}</p>
                                    </div>
                                    <div class="w-1/3 text-right">
                                        <p class="text-md">{{ parseFloat(product.price) | currency('€ ')}}</p>
                                        <p class="" v-if="product.stock === 1">
                                            <span class="text-green-500 font-medium font-sm flex justify-end align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                In stock
                                            </span>
                                        </p>
                                        <p v-if="product.stock === 0">
                                            <span class="text-red-500 font-medium font-sm flex justify-end align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                                Out of stock
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 h-32 xl:h-64 w-100 overflow-hidden">
                                <img class="object-contain object-center h-full w-full rounded-xl" v-if="product.thumbnail" :src="product.thumbnail">
                                <div class="w-100 h-100 flex items-center justify-center text-gray-200" v-if="!product.thumbnail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                        <button @click="openProductModal(product)" class="text-black rounded-lg absolute bottom-5 right-5 animate__animated animate__fadeInUp animate__faster">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex justify-center items-center" v-if="activeProduct && stepsLoading">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div class="font-medium my-10 text-sm xl:text-lg">Fetching steps</div>
                </div>
                <div class="space-y-5 " v-if="!stepsLoading" v-for="product in steps" >
                    <draggable :options="{animation:200, handle: '.handle'}" :element="'div'" @change="onOrderChange()">
                        <div v-for="(step, i) in product.steps" class="my-5 relative">
                            <div class="relative flex justify-between items-center pb-4">
                                <h1 class="text-base md:text-lg lg:text-2xl xl:text-3xl font-medium text-gray-900">{{ step.name }}</h1>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
                                <div v-for="(option, index) in step.options" v-bind:key="index" class="relative">
                                    <button v-on:click="addToChosenOptions(step, option)" class="bg-white border-2 rounded-xl transition border-gray-200 hover:border-indigo-500 relative flex flex-column animate__animated animate__fadeInUp animate__faster w-100 h-100" v-bind:key="option.id" :class="{'border-indigo-500': chosenOptions.some(chosenOption => chosenOption[0].options.includes(option)), 'pointer-events-none opacity-50': option.stock === 0}">
                                        <div class="absolute bg-indigo-500 rounded-full -right-3 -top-3" v-if="chosenOptions.some(chosenOption => chosenOption[0].options.includes(option))">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="p-3 border-b border-gray-300 h-auto w-100">
                                            <div class="flex">
                                                <div class="w-2/3 text-left">
                                                    <p class="font-bold">{{ option.name }}</p>
                                                    <p v-if="option.description" class="text-gray-800">{{ option.description.substring(0,32) }}</p>
                                                </div>
                                                <div class="w-1/3 text-right">
                                                    <p class="text-md" v-if="option.price">{{ parseFloat(option.price) | currency('€ ')}}</p>
                                                    <p class="text-md" v-if="!option.price">{{ parseFloat((activeProduct.price * option.percentage_increase)) | currency('€ ')}}</p>
                                                    <p class="" v-if="option.stock === 1">
                                                        <span class="text-green-500 font-medium font-sm flex justify-end align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                            In stock
                                                        </span>
                                                    </p>
                                                    <p v-if="option.stock === 0">
                                                        <span class="text-red-500 font-medium font-sm flex justify-end align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                            </svg>
                                                            Out of stock
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 h-32 xl:h-64 w-100 w-100 overflow-hidden">
                                            <img class="object-contain object-center h-full w-full rounded-xl" v-if="option.thumbnail" :src="option.thumbnail">
                                            <div class="w-100 h-100 flex items-center justify-center text-gray-200" v-if="!option.thumbnail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                    </button>
                                    <button @click="openProductModal(option)" class="text-black rounded-lg absolute bottom-5 right-5 animate__animated animate__fadeInUp animate__faster">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>

                                </div>
                                <button v-if="step.is_optional" v-on:click="removeChosenOptions(step)" class="bg-white border-2 rounded-xl transition border-gray-200 animate__animated animate__fadeInUp animate__faster" :class="{'border-indigo-500': chosenOptions.some(chosenOption => chosenOption[0].options.length === 0 ) || stepExistsInArray(step) === false }">
                                    <div class="flex p-3">
                                        <p>No thank you</p>
                                    </div>
                                </button>
                            </div>

                        </div>
                    </draggable>
                </div>
                <button @click="ProcessConfiguration" v-if="activeProduct" class="my-5 w-full bg-indigo-500 text-white p-3 rounded-lg hover:bg-indigo-500 transition font-medium">Finish configuration</button>
            </div>
            <Summary :active="activeProduct" :options="chosenOptions" :finished="finished" ref="summary"></Summary>
        </div>
        <ConfigurationModal ref="configurationModal" :active="activeProduct" :options="chosenOptions" :code="summary_code"></ConfigurationModal>
        <product-modal ref="productModal"></product-modal>

        <transition enter-active-class="animate__animated animate__slideInRight animate__faster" leave-active-class="animate__animated animate__slideOutRight animate__faster" mode="out-in">
            <div class="bg-white fixed h-screen w-full top-0 right-0 z-30 overflow-none shadow-lg flex items-center overflow-y-scroll" v-if="configurationFinished">
                <div class="relative h-100 p-10 xl:p-0 xl:left-1/4 w-full md:w-2/3 xl:w-1/3">
                    <h2 class="font-bold text-3xl">Your configuration(s)</h2>
                    <div class="grid grid-cols-1 divide-y divide-gray-200 my-10">
                        <div class="flex flex-column xl:flex-row space-y-6 xl:space-y-0 xl:space-x-6 py-5">
                            <div class="w-100 xl:w-1/4">
                                <img src="https://images.photowall.com/products/60869/azores-mountain-landscape-1.jpg" alt="" class="rounded-lg">
                            </div>
                            <div class="w-100 xl:w-3/4">
                                <p class="font-bold text-xl">{{ activeProduct.name }}</p>
                                <ul class="my-3">
                                    <div class="" v-for="(option, index) in chosenOptions" v-if="option[0].options.length" :key="option[0].step.id">
                                        <li class="text-gray-700 flex" v-for="option in option[0].options">
                                            <div class="w-1/2">
                                                {{ option.name }}
                                            </div>
                                            <div class="w-1/2 flex justify-end">
                                                {{ option.price | currency('€ ')}}
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end flex-column items-end">
                        <p class="text-md">Subtotal: {{ this.$refs.summary.calculateSum | currency('€ ') }}</p>
                        <p class="text-md">VAT: {{ this.$refs.summary.calculateSum * 0.21 | currency('€ ') }}</p>
                        <p class="font-bold text-xl">Total: {{ this.$refs.summary.calculateSum | currency('€ ') }}</p>
                    </div>
                    <div class="flex flex-column-reverse space-y-4 md:flex-row md:space-y-0 md:justify-between my-5">
                        <button @click="configurationFinished = false" class="bg-indigo-500 py-2 px-4 mt-4 md:mt-0 text-white rounded-lg flex items-center transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            Go back
                        </button>
                        <button @click="storeSummary" class="bg-white border border-gray-300 py-2 px-4 rounded-lg hover:shadow-lg flex items-center transition-all">
                            <svg class="animate-spin mr-2 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="summaryLoading">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Go to payment
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import Summary from "./summary/summaryComponent.vue";
    import ConfigurationModal from "./configurators/configurationModal.vue"
    import ProductModal from "./products/productModal.vue"
    import ChooseConfigurator from "./configurators/chooseConfiguratorComponent.vue"
    import ConfiguratorLoadingScreen from "./configurators/configuratorLoadingScreenComponent.vue";
    import draggable from 'vuedraggable'

    export default {
        data () {
            return {
                configurableProducts: [],
                activeProduct: '',
                summary: 0,
                chosenOptions: [],
                steps: [],
                stepsLoading: true,
                loading: true,
                summary_code: '',
                configurationFinished: false,
                configuratorChosen: false,
                configurators: [],
                configurator: '',
                summaryLoading: false,

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        components: {
            Summary,
            ConfigurationModal,
            ChooseConfigurator,
            ConfiguratorLoadingScreen,
            ProductModal,
            draggable,
        },
        mounted: function() {
            // this.getConfigurableProducts();
            this.getAllConfigurators();
        },
        computed: {
            // Only show the steps that a the selected product has
            filteredSteps() {
                return this.steps.filter(step => {
                    return step.includes(this.activeProduct.id)
                });
            },
        },
        methods: {
            openProductModal(product) {
                // console.log(this.$refs.productModal.showModal)
                this.$refs.productModal.product = product;
                this.$refs.productModal.showModal = true;
            },
            optionExistInArray: function(name) {
                let exists = false
                this.chosenOptions.forEach(function(value, i) {
                    value[0].options.forEach(function(chOption, index) {
                        if(chOption.name === name) {
                            exists = true;
                        }
                    });
                });
                return exists;
            },
            stepExistsInArray: function(step) {
                let exists = false
                this.chosenOptions.forEach(function(value, i) {
                    if(value[0].step === step) {
                        exists = true
                    }
                });
                return exists;
            },
            addToChosenOptions(step, option) {
                // Option is in stock
                if(option.stock === 1) {
                    // Check if the step where the option belongs to, exists in the array of ChosenOptions
                    if(this.chosenOptions.some(options => options[0].step.name === step.name)) {
                        // The step allows multiple select
                        if(step.allow_multiple) {
                            // The option exists in the array of selected options
                            if(this.optionExistInArray(option.name)){
                                // Loop through all the chosenOptions
                                this.chosenOptions.forEach(function(value, i) {
                                    // The step equals the step given
                                    if(value[0].step.name === step.name) {
                                        // the options array length is 1 (Meaning its the last one in the array)
                                        if (value[0].options.length === 1) {
                                            // Delete the whole array instead of only the option
                                            this.chosenOptions.splice(i, 1)
                                        } else {
                                            // The array's length is NOT 1 and thus only the options needs to be deleted
                                            value[0].options.forEach(function(chOption, index) {
                                                // If the option equals the option given
                                                if(chOption.name === option.name) {
                                                    // Delete the option from the array
                                                    value[0].options.splice(index, 1);
                                                }
                                            });
                                        }
                                    }
                                }, this);
                            } else {
                                // If the option does not exists in the array
                                this.chosenOptions.forEach(function(value, i) {
                                    // If the step name equals the given name
                                    if(value[0].step.name === step.name) {
                                        // Push the option to the right options array
                                        value[0].options.push(option)
                                    }
                                },this);
                            }
                        } else {
                            // If the stap does NOT allow for multiple select
                            this.chosenOptions.forEach(function(value, i) {
                                // If the step equals the given step
                                if(value[0].step.name === step.name) {
                                    // Replace the current option with the new option
                                    Vue.set(this.chosenOptions[i][0].options, 0, option)
                                }
                            }, this);
                        }
                    } else {
                        // If neither do exist at all in the array, Add the stap AND the option to the array
                        this.chosenOptions.push([{step: step, options: [option]}])
                    }
                }
            },
            removeChosenOptions: function(step) {
                this.chosenOptions.forEach(function(value, index) {
                    if(value[0].step.name === step.name) {
                        this.chosenOptions.splice(index, 1)
                    }
                }, this);
            },
            getConfigurableProducts: function(id) {
                axios.all([
                    axios.get('/api/get/configurable_products/' + id)
                    .then(response => {
                        this.configurableProducts = response.data
                    }).catch(err => {
                        console.log(err)
                    }),
                    axios.get('/api/get/configuration/' + id)
                        .then(response => {
                            this.configurator = response.data
                            this.configuratorChosen = true
                        }).catch(err => {
                        console.log(err)
                    })
                ]);
            },
            getAllConfigurators: function() {
                axios.get('/api/get/all/configurators')
                    .then(response => {
                        this.configurators = response.data
                        this.loading = false
                    }).catch(err => {
                    console.log(err)
                });
            },
            getAllRelatedSteps: function(id) {
                axios.get('/api/get/getRelatedSteps/' +  id)
                    .then(response => {
                        this.steps = response.data

                        this.addDefaultProductsToArrayBeforehand()

                        this.stepsLoading = false
                    }).catch(err => {
                    console.log(err)
                });
            },
            addDefaultProductsToArrayBeforehand() {
                this.steps[0].steps.forEach(function(value, index) {
                    value.options.forEach(function(option, index) {
                        if(option.id === value.default_product) {
                            this.chosenOptions.push([{step: value, options: [option]}])
                        }
                    }, this);
                }, this);
            },
            ProcessConfiguration: function() {
                // document.getElementById("generatePDF").submit();
                this.configurationFinished = true;
            },
            storeSummary: function() {
                this.summaryLoading = true
                axios.post('/api/store/summary', {
                    parent: this.activeProduct,
                    options: this.chosenOptions,
                }).then(response => {
                    setTimeout(() => this.summaryLoading = false, 3000);
                    location.reload();
                }).catch(err => {

                });
            },
            getConfigurableProducts: function(id) {
                axios.all([
                    axios.get('/api/get/configurable_products/' + id)
                        .then(response => {
                            this.configurableProducts = response.data
                        }).catch(err => {
                        console.log(err)
                    }),
                    axios.get('/api/get/configuration/' + id)
                        .then(response => {
                            this.configurator = response.data
                            this.configuratorChosen = true

                        }).catch(err => {
                        console.log(err)
                    })
                ]);
            },
        }
    }
</script>
