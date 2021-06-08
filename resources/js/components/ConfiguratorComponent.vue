<template>
    <div class="container-fluid px-0">
        <transition name="fade">
            <div class="bg-white fixed w-screen h-screen top-0 right-0 flex items-center justify-center flex-column z-30" v-if="!configuratorChosen">
                <h2 class="text-3xl font-medium my-5 animate__animated animate__fadeInUp">Wat wil je configureren?</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div v-for="(configator, i) in configurators" class="bg-white shadow-sm relative min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200 cursor-pointer animate__animated animate__fadeInUp animate__delay-1s cardhover" :style="styleBorder(configator.theme_color)">
                        <div v-on:click="getConfigurableProducts(configator.id)">
                            <div class="p-3">
                                <p class="font-medium text-xl text-center">{{ configator.name }}</p>
                                <div class=" w-64 flex items-center justify-center h-32">
                                    foto
                                </div>
                                <p class="text-gray-500">V.a {{ Math.min.apply(Math, lowestPriceInConfigurator(configurator.id)[i]['prices'][0]) | currency('€ ')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

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
            <div class="configurator bg-white relative xl:w-8/12 w-full min-h-screen p-10 pt-20 lg:p-20 space-y-15">
                <div class="absolute top-5 left-5 flex justify-center items-center hover:text-indigo-500" v-on:click="configuratorChosen = false, activeProduct = '', chosenOptions = [], steps = []">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <p class="text-gray-800 font-medium text-lg  cursor-pointer hover:text-indigo-500" >Andere configurator kiezen</p>
                </div>

                <div class="relative flex justify-between items-center pb-4">
                    <h1 class="text-3xl font-medium">{{ configurator.name }} configureren</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
                    <button v-for="product in configurableProducts" v-bind:key="product.id" type="button" class="bg-white shadow-sm relative min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), chosenOptions = [], getAllRelatedSteps(product.id)]" :class="{'border-indigo-500': activeProduct === product }">
                        <div class="absolute bg-indigo-500 rounded-full -right-3 -top-3" v-if="activeProduct === product">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
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


<!--                <article class="option my-3 transition-all" :class="accordionClass">-->
<!--                    <div class="header border border-gray-500 p-2 cursor-pointer" @click="toggleAccordion">-->
<!--                        even testen-->
<!--                    </div>-->
<!--                    <div class="message border-b border-r border-l border-gray-500 overflow-hidden p-0 transition-all h-40" :class="accordionContainer">-->
<!--                        <div class="body p-4" :class="accordionBody">-->
<!--                            Bericht-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </article>-->


                <div class="space-y-5" v-if="!stepsLoading" v-for="product in steps">
                    <draggable :options="{animation:200, handle: '.handle'}" :element="'div'" @change="onOrderChange()">
                        <div v-for="(step, i) in product.steps" class="my-5 relative">
                            <div class="relative flex justify-between items-center pb-4">
                                <h1 class="text-3xl font-medium">{{ step.name }}</h1>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
                                <button v-on:click="addToChosenOptions(step, option)" class="bg-white border-2 rounded-xl transition border-gray-200 hover:border-indigo-500 relative" v-for="(option, index) in step.options" v-bind:key="option.id" :class="{'border-indigo-500': chosenOptions.some(chosenOption => chosenOption[0].options.includes(option))}">
                                    <div class="absolute bg-indigo-500 rounded-full -right-3 -top-3" v-if="chosenOptions.some(chosenOption => chosenOption[0].options.includes(option))">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
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
                <button @click="ProcessConfiguration(), openModal()" v-if="activeProduct" class="my-5 w-full bg-indigo-500 text-white p-3 rounded-lg hover:bg-indigo-500 transition font-medium">Configuratie afronden</button>
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
                configurationFinished: false,
                configuratorChosen: false,
                configurators: [],
                configurator: '',
                // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        components: {
            Summary,
            ConfigurationModal,
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
            }
        },
        methods: {
            openModal() {
                this.$refs.ConfigurationModal.showModal = true;
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
            getConfigurableProducts: function(id) {
                axios.all([
                    axios.get('/api/get/configurable_products/' + id)
                    .then(response => {
                        this.configurableProducts = response.data
                        this.loading = false
                    }).catch(err => {
                        console.log(err)
                    }),
                    axios.get('/api/get/configuration/' + id)
                        .then(response => {
                            this.configurator = response.data
                            this.configuratorChosen = true
                            this.loading = false
                        }).catch(err => {
                        console.log(err)
                    })
                ]);
            },
            getAllConfigurators: function() {
                axios.get('/api/get/all/configurators')
                    .then(response => {
                        this.configurators = response.data
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
                console.log("Default producten toevoegen aan array")
                this.steps[0].steps.forEach(function(value, index) {
                    value.options.forEach(function(option, index) {
                        if(option.id === value.default_product) {
                            this.chosenOptions.push([{step: value, options: [option]}])
                        }
                    }, this);
                }, this);
                // this.chosenOptions.push([{step: step, options: [option]}])
            },
            openModal: function() {
                this.$refs.configurationModal.showModal = true;
            },
            ProcessConfiguration: function() {
                this.configurationFinished = true



            },
            lowestPriceInConfigurator: function(id) {
                let array = [];
                this.configurators.forEach(function(value, i) {
                    let prices =  []
                    value.products.forEach(function(item, i) {
                        if(item.configurable) {
                            prices.push(parseFloat(item.price))
                        }

                    })
                    array.push({configurator: i, prices: [prices]})
                });

                return array;
                // this.configurators[0].products.forEach(function(value, i) {
                //     array.push(value.price);
                // });


            },
            styleBorder: function(themeColor) {
                return {'--borderHoverColor': themeColor};
            }
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
    .cardhover:hover {
        border-color: var(--borderHoverColor) !important;
    }
</style>
