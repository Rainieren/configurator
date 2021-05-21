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
                    <button v-for="product in configurableProducts" v-bind:key="product.id" type="button" class="bg-white shadow-sm min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), chosenOptions = [], getAllRelatedSteps(product.id)]" :class="{'border-indigo-500': activeProduct === product }">
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
                        <div class="p-3 h-64 w-100 overflow-hidden">
                            <img class="object-contain object-center h-full w-full rounded-xl" v-if="product.thumbnail" :src="product.thumbnail">
                            <div class="w-100 h-100 flex items-center justify-center text-gray-200" v-if="!product.thumbnail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-3 text-left" v-if="product.height || product.length || product.width || product.weight">
                            <p class="text-gray-500 text-sm" v-if="product.height">Height: {{ product.height }}</p>
                            <p class="text-gray-500 text-sm" v-if="product.length">Length: {{ product.length }}</p>
                            <p class="text-gray-500 text-sm" v-if="product.length">Width: {{ product.width }}</p>
                            <p class="text-gray-500 text-sm" v-if="product.length">Weight: {{ product.weight }}</p>
                        </div>
                    </button>
                </div>

                <div class="space-y-5" v-if="!stepsLoading" v-for="product in steps">

                    <draggable :options="{animation:200, handle: '.handle'}" :element="'div'" @change="onOrderChange()">
                        <div v-for="step in product.steps" class="my-5 relative">


                            <div class="handle mr-3 cursor-pointer absolute top-1 -left-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </div>
                            <p class="text-black text-2xl font-medium mb-3">{{ step.name }}</p>
    <!--                        TODO:: Dit moet collapable zijn, wanneer iemand de configuratie afrond moet de stap er zo uitzien -->
    <!--                        <div class="flex border-b border-gray-300 py-3 items-center my-2">-->
    <!--                            <div class="w-1/2 flex items-center">-->
    <!--                                <div class="h-12 w-12 bg-indigo-500 rounded-full  flex items-center justify-center text-white">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
    <!--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />-->
    <!--                                    </svg>-->
    <!--                                </div>-->
    <!--                                <p class="text-black text-2xl font-medium ml-3">{{ step.name }}</p>-->
    <!--                            </div>-->
    <!--                            <div class="w-1/2 flex justify-end items-center">-->
    <!--                                <a href="" class="text-gray-500 font-medium">Bewerken</a>-->
    <!--                            </div>-->
    <!--                        </div>-->

                            <div class="grid grid-cols-3 gap-6">
                                <button v-on:click="addToChosenOptions(step, option)" class="bg-white border-2 rounded-xl transition border-gray-200 hover:border-indigo-500" v-for="(option, index) in step.options" v-bind:key="option.id" :class="{'border-indigo-500': chosenOptions.some(chosenOption => chosenOption[0].options.includes(option))}">
                                    <div class="p-3 border-b border-gray-300">
                                        <div class="flex">
                                            <div class="w-2/3 text-left">
                                                <p class="font-bold">{{ option.name }}</p>
                                                <p v-if="option.description" class="text-gray-800">{{ option.description.substring(0,32) }}</p>
                                            </div>
                                            <div class="w-1/3 text-right">
                                                <p class="text-md" v-if="option.price">{{ parseFloat(option.price) | currency('€ ')}}</p>
                                                <p class="text-md" v-if="!option.price">{{ parseFloat((activeProduct.price * option.percentage_increase)) | currency('€ ')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 h-64 w-100 overflow-hidden">
                                        <img class="object-contain object-center h-full w-full rounded-xl" v-if="option.thumbnail" :src="option.thumbnail">
                                        <div class="w-100 h-100 flex items-center justify-center text-gray-200" v-if="!option.thumbnail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-3 text-left" v-if="option.height || option.length || option.width || option.weight">
                                        <p class="text-gray-500 text-sm" v-if="option.height">Height: {{ option.height }}</p>
                                        <p class="text-gray-500 text-sm" v-if="option.length">Length: {{ option.length }}</p>
                                        <p class="text-gray-500 text-sm" v-if="option.length">Length: {{ option.width }}</p>
                                        <p class="text-gray-500 text-sm" v-if="option.length">Length: {{ option.weight }}</p>
                                    </div>
                                </button>
                                <button v-if="step.is_optional" v-on:click="removeChosenOptions(step)" class="bg-white border-2 rounded-xl transition border-gray-200" :class="{'border-indigo-500': chosenOptions.some(chosenOption => chosenOption[0].options.length === 0 ) || stepExistsInArray(step) === false }">
                                    <div class="flex p-3">
                                        <p>No thank you</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </draggable>
                </div>
                <button @click="ProcessConfiguration()" v-if="activeProduct" class="my-5 w-full bg-indigo-500 text-white p-3 rounded-lg hover:bg-indigo-500 transition font-medium">Configuratie afronden</button>
            </div>
            <Summary :active="activeProduct" :options="chosenOptions"></Summary>
        </div>
        <ConfigurationModal ref="configurationModal" :active="activeProduct" :options="chosenOptions" :code="summary_code"></ConfigurationModal>
    </div>
</template>

<script>
    import Summary from "./summary/summaryComponent.vue";
    import ConfigurationModal from "./configurationModal.vue"
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
                // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            };
        },
        components: {
            Summary,
            ConfigurationModal,
            draggable,
        },
        mounted: function() {
            this.getConfigurableProducts();
        },
        methods: {
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
            onOrderChange() {

            },
            addToChosenOptions(step, option) {
                // Stap komt overeen met de stap die al in de array staat
                if(this.chosenOptions.some(options => options[0].step.name === step.name)) {
                    if(step.allow_multiple) {
                        if(this.optionExistInArray(option.name)){
                            this.chosenOptions.forEach(function(value, i) {
                                value[0].options.forEach(function(chOption, index) {
                                    if(chOption.name === option.name) {
                                        value[0].options.splice(index, 1);
                                    }
                                });
                            });
                        } else {
                            this.chosenOptions.forEach(function(value, i) {

                                if(value[0].step.name === step.name) {
                                    value[0].options.push(option)
                                }
                            },this);
                        }
                    } else {
                        // Stap staat NIET meerdere producten toe
                        this.chosenOptions.forEach(function(value, i) {
                            // Als de stap overeen komt met de stap die in de array staat
                            if(value[0].step.name === step.name) {
                                // Vervang de huidige optie met de nieuwe
                                Vue.set(this.chosenOptions[i][0].options, 0, option)
                            }
                        }, this);
                    }
                } else {
                    this.chosenOptions.push([{step: step, options: [option]}])
                }
            },
            removeChosenOptions: function(step) {
                this.chosenOptions.forEach(function(value, i) {
                    if(value[0].step.name === step.name) {
                        value[0].options = []
                        return
                    }
                });
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
