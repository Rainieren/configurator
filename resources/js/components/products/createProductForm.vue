<template>
    <div class="px-20">
        <div class="flex space-x-10">
            <div class="w-6/12">
                <form action="/dashboard/product/store" method="POST" class="w-full my-2" id="productCreateForm">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Name</p>
                        </div>
                        <div class="w-8/12">
                            <input v-model="fields.name"  v-model.trim="$v.name.$model" name="name" id="name" type="text" :class="{ 'border-red-500' : submitted && $v.name.$error}" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm" >
                            <p class="error text-red-500" v-if="submitted && !$v.name.required">Naam is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Configurable product</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input v-model="fields.isConfigurableProduct" v-on:click="isConfigurableProductFunc()" id="configurable_product" name="configurable_product" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="configurable_product" class="font-medium text-gray-700">This product is a configurable product</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Price</p>
                        </div>
                        <div class="w-8/12">
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm">
                                    €
                                  </span>
                                </div>
                                <input v-model="fields.price" v-model.trim="$v.price.$model" v-mask="mask" :class="{ 'border-red-500' : submitted && $v.price.$error}" type="text" name="price" id="price" class="block w-full pl-8 pr-2 py-2 border border-gray-300 rounded-md" placeholder="0.00" :disabled="fields.hasPriceIncrease">
                            </div>
                            <p class="error text-red-500" v-if="submitted && !$v.price.required">Prijs is verplicht!</p>
                            <div class="" v-if="!fields.isConfigurableProduct">
                                <fieldset>
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input v-model="fields.hasPriceIncrease" v-on:click="priceIncreaseFunc()" id="price_increase" name="price_increase" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-200 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="comments" class="font-medium text-gray-700">This product has a price increase</label>
                                                <p class="text-gray-500">Select this option if the product should increase the price with a percentage</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div v-if="fields.hasPriceIncrease" class="my-3">
                                    <label for="percentage" class="font-medium text-gray-700">Percentage</label>
                                    <input v-model="fields.priceIncrease" v-model.trim="$v.price_percentage.$model" :class="{ 'border-red-500' : submitted && $v.price_percentage.$error}" type="text" name="percentage" id="percentage" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                                    <p class="error text-red-500" v-if="submitted && !$v.price_percentage.required">Percentage is verplicht!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">SKU</p>
                        </div>
                        <div class="w-8/12">
                            <input v-model="fields.sku" v-model.trim="$v.sku.$model" type="text" id="sku" name="sku"  :class="{ 'border-red-500' : submitted && $v.sku.$error}" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                            <p class="error text-red-500" v-if="submitted && !$v.sku.required">SKU is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Stock</p>
                            <p class="text-gray-500">How much do you have in stock?</p>
                        </div>
                        <div class="w-8/12">
                            <input v-model="fields.stock" v-model.trim="$v.stock.$model" :maxlength="10" v-on:keypress="isLetter($event)" type="text" id="stock" name="stock" :class="{ 'border-red-500' : submitted && $v.stock.$error}" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                            <p class="error text-red-500" v-if="submitted && !$v.stock.required">Voorraad is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Description</p>
                        </div>
                        <div class="w-8/12">
                            <textarea v-model="fields.description" id="description" name="description" rows="5" class="p-2 shadow-sm block w-full border border-gray-300 rounded-md" placeholder="Write something beautiful"></textarea>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Thumbnail</p>
                        </div>
                        <div class="w-8/12">
                            <div>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnail-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="thumbnail-upload" v-on:change="onThumbnailChanged" name="thumbnail-upload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Visualisation</p>
                            <p class="text-gray-500">Upload a visualisation of the product</p>
                        </div>
                        <div class="w-8/12">
                            <div>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="visualisation-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="visualisation-upload" @change="onVisualisationChanged" name="visualisation-upload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Product attributes</p>
                            <p class="text-gray-500">These values are configured in centimeters. To change to another unit of measurement. Go to settings</p>
                        </div>
                        <div class="w-8/12">
                            <div class="mb-3">
                                <label for="weight" class="font-medium text-gray-700">Weight</label>
                                <input v-model="fields.weight" type="text" name="weight" :maxlength="10" v-on:keypress="isLetter($event)" id="weight" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="height" class="font-medium text-gray-700">Height</label>
                                <input v-model="fields.height" type="text" name="height" :maxlength="10" v-on:keypress="isLetter($event)" id="height" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="length" class="font-medium text-gray-700">Length</label>
                                <input v-model="fields.length" type="text" name="length" :maxlength="10" v-on:keypress="isLetter($event)" id="length" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="width" class="font-medium text-gray-700">Width</label>
                                <input v-model="fields.width" type="text" name="width" :maxlength="10" v-on:keypress="isLetter($event)" id="width" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Set product as new from</p>
                        </div>
                        <div class="w-8/12">
                            <div class="flex">
                                <input v-model="fields.newFrom" type="date" name="new_from" id="new_from" v-on:change="alert('test')" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                                <div class="mx-3 flex items-center justify-center">
                                    <p class="text-gray-900 font-medium">To</p>
                                </div>
                                <input v-model="fields.newTo" type="date" name="new_to" id="new_to" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Manufacturer</p>
                            <p class="text-gray-500">Who made the product?</p>
                        </div>
                        <div class="w-8/12">
                            <select v-model="fields.manufacturer" type="text" name="manufacturer" id="manufacturer" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm" :disabled="fields.hasManufacturer">
                                <option :value="manufacturer.id" v-for="manufacturer in manufacturers">{{  manufacturer.name }}</option>
                            </select>
                            <fieldset>
                                <div class="mt-3 space-y-2">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input v-model="fields.hasManufacturer" @click="fields.manufacturer = ''" id="has_manufacturer" name="has_manufacturer" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="has_manufacturer" class="font-medium text-gray-700">This product does not have a manufacturer</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div v-if="!fields.isConfigurableProduct">
                        <hr class="my-4">
                        <div class="flex space-x-5">
                            <div class="w-4/12">
                                <p class="text-gray-800 font-medium text-lg">Interaction type</p>
                                <p class="text-gray-500">How do you want user to interact with this product?</p>
                            </div>
                            <div class="w-8/12">
                                <fieldset>
                                    <div class="space-y-4">

                                        <div class="flex items-center">
                                            <input v-model="fields.interactionType" @click="fields.interactionInputType = ''" id="configuration_card" name="interaction_type" value="1" type="radio" class="mr-3 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="push_everything" class="block text-sm font-medium text-gray-700 mb-0">
                                                    Card
                                                </label>

                                                <p class="text-gray-400 text-sm font-medium m-0">The product is clickable using a card</p>

                                            </div>

                                        </div>
                                        <div class="flex items-center">
                                            <input v-model="fields.interactionType" id="configuration_input" name="interaction_type" value="2" type="radio" class="mr-3 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="configuration_input" class="mb-0 block text-sm font-medium text-gray-700">
                                                    Input field
                                                </label>
                                                <p class="text-gray-400 text-sm font-medium m-0">The user can type in what they want</p>
                                            </div>
                                        </div>

                                        <div v-if="fields.interactionType === 'input'" class="my-3">
                                            <label for="input_field_type" class="font-medium text-gray-700">What type of input field?</label>
                                            <select v-model="fields.interactionInputType" type="text" name="input_field_type" id="input_field_type" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                                <option value="text">Plain text</option>
                                                <option value="date">Date</option>
                                                <option value="passsword">Password</option>
                                            </select>
                                        </div>

                                        <div class="flex items-center">
                                            <input v-model="fields.interactionType"  @click="fields.interactionInputType = ''" id="configuration_input" name="interaction_type" value="3" type="radio" class="mr-3 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="configuration_input" class="mb-0 block text-sm font-medium text-gray-700">
                                                    Radio button
                                                </label>
                                                <p class="text-gray-400 text-sm font-medium m-0">The user can select what they want using rounded buttons</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex space-x-5">
                            <div class="w-4/12">
                                <p class="text-gray-800 font-medium text-lg">Step</p>
                                <p class="text-gray-500">To what step does this product belong to?</p>
                            </div>
                            <div class="w-8/12">
                                <select v-model="fields.step" type="text" name="step" id="step" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                    <option v-for="step in steps" :value="step.id" selected>{{ step.name }}</option>
                                </select>
                                <p class="font-medium text-red-500 my-2">This product can only be applied to steps that have products with the same configuration type! Please choose a step with where all the products are [variable] aswell.</p>
                                <p class="text-gray-400 my-2">If there are no steps with your chosen configuration you can create a new step. Or change the product configuration</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex float-right my-5 space-x-5">
                        <a href="" class="bg-gray-300 rounded p-2 text-centet text-black hover:text-indigo-500 hover:no-underline transition">Cancel</a>
                        <button @click.prevent="submitProductCreateForm" type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Create product</button>
                    </div>
                </form>
            </div>
            <div class="w-6/12 relative">
                <div class="sticky top-20  w-full flex items-center flex-column">
                    <p class="font-medium text-2xl mb-3">Preview</p>
                    <product-preview :data="fields"></product-preview>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    import createNumberMask from 'text-mask-addons/dist/createNumberMask';
    import productPreview from "./productPreview.vue";
    import radioPreview from "./radioPreview";
    import { required, email, minLength, maxLength, requiredIf } from "vuelidate/lib/validators";

    const currencyMask = createNumberMask({
        prefix: '',
        allowDecimal: true,
        decimalSymbol: '.',
        includeThousandsSeparator: true,
        thousandsSeparatorSymbol: ',',
        allowNegative: false,
    });

    export default {
        data () {
            return {
                fields: {
                    name: "",
                    isConfigurableProduct: false,
                    hasPriceIncrease: false,
                    price: null,
                    priceIncrease: null,
                    sku: '',
                    stock: '',
                    description: '',
                    thumbnail: '',
                    thumbnailPreview: null,
                    visualisation: '',
                    weight: null,
                    length: null,
                    height: null,
                    width: null,
                    newFrom: null,
                    newTo: null,
                    manufacturer: '',
                    hasManufacturer: false,
                    interactionType: null,
                    interactionInputType: '',
                    step: '',
                },
                mask: currencyMask,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                manufacturers: {},
                steps: {},
                submitted: false,
            };
        },
        components: {
            productPreview,
            radioPreview
        },
        mounted: function() {
            this.getManufacturers();
            this.getSteps();
        },
        computed: {

        },
        methods: {
            isConfigurableProductFunc() {
                if(!this.fields.isConfigurableProduct) {
                    this.fields.priceIncrease = null
                    this.fields.hasPriceIncrease = false
                    this.fields.interactionType = null
                    this.fields.interactionInputType = ''
                    this.fields.step = ''
                }
            },
            priceIncreaseFunc() {
                if(!this.hasPriceIncrease) {
                    this.fields.price = null
                } else {
                    this.fields.priceIncrease = null
                }
            },
            onThumbnailChanged (event) {
                const file = event.target.files[0];
                this.fields.thumbnailPreview = URL.createObjectURL(file);
            },
            onVisualisationChanged(event) {
                this.fields.visualisation = event.target.files[0]
            },
            getManufacturers: function() {
                axios.get('/api/get/manufacturers')
                    .then(response => {
                        this.manufacturers = response.data
                    }).catch(err => {
                    console.log("There has been an error getting all manufacturers")
                });
            },
            getSteps: function() {
                axios.get('/api/get/steps')
                    .then(response => {
                        this.steps = response.data
                    }).catch(err => {
                    console.log("There has been an error getting all manufacturers")
                });
            },
            submitProductCreateForm: function() {
                this.submitted = true
                this.$v.$touch()

                if(this.$v.$error) {
                    return
                } else {
                    document.getElementById("productCreateForm").submit();
                }
            },
            isLetter: function(event) {
                event = (event) ? event : window.event;
                var charCode = (event.which) ? event.which : event.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    event.preventDefault();;
                } else {
                    return true;
                }
            },
        },
        validations: {
            name: {
                required
            },
            price: {
                required: requiredIf(function() {
                    return !this.fields.hasPriceIncrease
                })
            },
            price_percentage: {
                required: requiredIf(function() {
                    return this.fields.hasPriceIncrease
                })
            },
            stock: {
                required
            },
            sku: {
                required
            }
        }
    }
</script>
