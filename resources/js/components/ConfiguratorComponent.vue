<template>
    <div class="container-fluid">
        <div class="flex m-5 w-75">
            <div class="w-1/2 space-y-10">
                <div class="grid grid-cols-3 gap-6">
                    <button v-for="product in configurableProducts" v-bind:key="product.id" type="button" class="bg-white shadow-sm min-h-32 hover:shadow-xl hover:border-blue-500 transition rounded-lg border-2 border-gray-200" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), chosenOptions = [], getAllRelatedSteps(product.id)]" :class="{'border-blue-500': activeProduct === product }">
                        <div class="p-3 border-b border-gray-300">
                            <div class="flex">
                                <div class="w-2/3 text-left">
                                    <p class="font-bold">{{ product.name }}</p>
                                    <p v-if="product.description" class="text-gray-800">{{ product.description.substring(0,32) }}</p>
                                </div>
                                <div class="w-1/3 text-right">
                                    <p class="text-md">€ {{ product.price }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 flex justify-center items-center">
                            <img class="rounded" :src="product.thumbnail" width="50%">
                        </div>
                        <div class="p-3 text-left">
                            <p class="text-gray-500 text-sm">Height: {{ product.height }}</p>
                            <p class="text-gray-500 text-sm">Length: {{ product.length }}</p>
                        </div>
                    </button>
                </div>
                <div class="space-y-5" v-if="!stepsLoading" v-for="product in steps">
                    <div v-for="step in product.steps" class="">
                        <p class="text-black text-2xl mb-3 font-bold font-serif mb-4">{{ step.name }}</p>
                        <div class="grid grid-cols-3 gap-6">
                            <button v-on:click="addToChosenOptions(step.name, option)" class="bg-white border-2 rounded transition border-gray-200" v-for="option in step.options" v-bind:key="option.id" :class="{'border-blue-500': chosenOptions.some(chosenOption => chosenOption[0].option === option)}">
                                <div class="p-3 border-b border-gray-300">
                                    <div class="flex">
                                        <div class="w-2/3 text-left">
                                            <p class="font-bold">{{ option.name }}</p>
                                            <p v-if="option.description" class="text-gray-800">{{ option.description.substring(0,32) }}</p>
                                        </div>
                                        <div class="w-1/3 text-right">
                                            <p class="text-md">€ {{ option.price }}</p>
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
            </div>
            <div class="w-1/2">
                <div class="flex my-3" v-if="activeProduct">
                    <div class="w-1/2">
                        <p class="text-xl text-gray-700">{{ activeProduct.name }}</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-xl text-gray-700">€ {{ activeProduct.price }}</p>
                    </div>
                </div>

                <div class="flex my-3" v-for="option in chosenOptions">
                    <div class="w-1/2">
                        <p class="text-xl text-gray-700">{{option[0].step}} : {{ option[0].option.name }}</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-xl text-gray-700">€ {{ option[0].option.price }}</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2">
                        <p class="text-black text-3xl font-bold font-serif">Totaal:</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-black text-3xl font-bold font-serif">€ {{ chosenOptions.reduce((acc, item) => acc += parseFloat(item[0].option.price), 0) + parseFloat(activeProduct.price) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                configurableProducts: [],
                activeProduct: '',
                summary: 0,
                chosenOptions: [],
                steps: [],
                stepsLoading: true,
            };
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
                    this.summary += parseFloat(option.price)
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
