<template>
    <div class="container-fluid">
        <transition name="fade">
            <div class="w-screen h-screen absolute top-0 right-0 flex items-center justify-center bg-white flex-column" v-if="loading">
                <svg class="animate-spin h-12 w-12 my-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class=" text-xl">Producten ophalen, even geduld aub...</p>
            </div>
        </transition>

        <div class="flex flex-col xl:flex-row" v-if="!loading">
            <div class="configurator bg-white xl:w-8/12 w-full min-h-screen p-20 space-y-15">
                <h1 class="text-4xl font-medium mb-20">Product configureren</h1>
                <!--        TODO:: Move this part into a new component called configurableProductComponent.vue -->
                <div class="grid grid-cols-3 gap-6">
                    <button v-for="product in configurableProducts" v-bind:key="product.id" type="button" class="bg-white shadow-sm min-h-32 hover:shadow-xl hover:border-blue-500 transition rounded-xl border-2 border-gray-200" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), chosenOptions = [], getAllRelatedSteps(product.id)]" :class="{'border-blue-500': activeProduct === product }">
                        <div class="p-3 border-b border-gray-300">
                            <div class="flex">
                                <div class="w-2/3 text-left">
                                    <p class="font-bold">{{ product.name }}</p>
                                    <p v-if="product.description" class="text-gray-800">{{ product.description.substring(0,32) }}</p>
                                </div>
                                <div class="w-1/3 text-right">
                                    <p class="text-md">{{ parseFloat(product.price) | currency('€ ')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 flex justify-center items-center h-64">
                            <img class="rounded" :src="product.thumbnail" width="50%">
                        </div>
                        <div class="p-3 text-left">
                            <p class="text-gray-500 text-sm">Height: {{ product.height }}</p>
                            <p class="text-gray-500 text-sm">Length: {{ product.length }}</p>
                        </div>
                    </button>
                </div>
                <div class="space-y-5" v-if="!stepsLoading" v-for="product in steps">
                    <div v-for="step in product.steps" class="my-5">
                        <p class="text-black text-2xl mb-3 font-medium mb-4">{{ step.name }}</p>
                        <div class="grid grid-cols-3 gap-6">
                            <button v-on:click="addToChosenOptions(step.name, option)" class="bg-white border-2 rounded-xl transition border-gray-200" v-for="option in step.options" v-bind:key="option.id" :class="{'border-blue-500': chosenOptions.some(chosenOption => chosenOption[0].option === option)}">
                                <div class="p-3 border-b border-gray-300">
                                    <div class="flex">
                                        <div class="w-2/3 text-left">
                                            <p class="font-bold">{{ option.name }}</p>
                                            <p v-if="option.description" class="text-gray-800">{{ option.description.substring(0,32) }}</p>
                                        </div>
                                        <div class="w-1/3 text-right">
                                            <p class="text-md" v-if="option.price">{{ parseFloat(option.price) | currency('€ ')}}</p>
                                            <p class="text-md" v-if="option.percentage_increase">{{ parseFloat((activeProduct.price * option.percentage_increase)) | currency('€ ')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 flex justify-center items-center">
                                    <img class="rounded" :src="option.thumbnail" width="50%">
                                </div>
                                <div class="p-3 text-left">
                                    <p class="text-gray-500 text-sm">Height: {{ option.height }}</p>
                                    <p class="text-gray-500 text-sm">Length: {{ option.length }}</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <button @click="ProcessConfiguration()" v-if="activeProduct" class="my-5 w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-700 transition font-medium">Configuratie afronden</button>
            </div>
            <Summary :active="activeProduct" :options="chosenOptions"></Summary>
        </div>
        <ConfigurationModal ref="configurationModal" :active="activeProduct" :options="chosenOptions" :code="summary_code"></ConfigurationModal>
    </div>
</template>

<script>
    import Summary from "./summary/summaryComponent.vue";
    import ConfigurationModal from "./configurationModal.vue"

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
                // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            };
        },
        components: {
            Summary,
            ConfigurationModal
        },
        mounted: function() {
            this.getConfigurableProducts();
        },
        methods: {
            addToChosenOptions(step_name, option) {
                if(this.chosenOptions.some(option => option[0].step === step_name)) {
                    this.chosenOptions.forEach(function(value, i) {
                        if(value[0].step === step_name) {
                            value[0].option = option
                        }
                    });
                    if(option.price) {
                        this.summary += parseFloat(option.price)
                    } else {
                        console.log('Prijs ophogen met percentage');
                    }
                } else {
                    this.chosenOptions.push([{step: step_name, option: option}])
                }
            },
            getConfigurableProducts: function() {
                axios.get('/api/get/configurable_products')
                    .then(response => {
                        this.configurableProducts = response.data
                        this.loading = false
                    }).catch(err => {
                    console.log(err)
                });
            },
            getAllRelatedSteps: function(id) {
                axios.get('/api/get/getRelatedSteps/' +  id)
                    .then(response => {
                        this.steps = response.data
                        this.stepsLoading = false
                    }).catch(err => {
                    console.log(err)
                });
            },
            openModal: function() {
                this.$refs.configurationModal.showModal = true;
            },
            ProcessConfiguration: function() {
                axios.post('/api/store/configuration', {
                    activeProduct: this.activeProduct,
                    chosenOptions: this.chosenOptions
                }).then(response => {
                    console.log(response.data)
                    this.summary_code = response.data.code
                    this.openModal();
                }).catch(err => {
                    console.log('Er is iets mis gegaan tijdens het opslaan van de configuratie')
                    console.log(err);
                })

            }
        },
        computed: {
            // Only show the steps that a the selected product has
            filteredSteps() {
                return this.steps.filter(step => {
                    return step.includes(this.activeProduct.id)
                });
            },
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
