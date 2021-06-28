<template>
    <div>
        <div class="px-10 pt-5 pb-5 md:px-20 md:pt-10 md:pb-10">
            <div class="flex">
                <div class="w-100 lg:w-1/2 flex items-center">
                    <p class="text-base md:text-lg lg:text-2xl xl:text-3xl font-extrabold text-gray-900">{{ fields.name }}</p>
                </div>
            </div>
        </div>
        <div class="px-10 md:px-20">
            <div class="flex flex-column xl:flex-row xl:space-x-10">
                <div class="w-100 xl:w-8/12">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Name</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="relative">
                                <input name="name" id="name" v-model.trim="$v.fields.name.$model" type="text" :class="{ 'border-red-500' : submitted && !$v.fields.name.required}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" autofocus>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.name.required">
                                    <svg v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-500 font-medium my-3" v-if="submitted && !$v.fields.name.required">Naam is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Optional</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <fieldset>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <div class="flex items-center h-5">
                                            <div class="flex justify-between items-center" @click="[fields.is_optional = !fields.is_optional]">
                                                <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.is_optional}">
                                                    <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.is_optional}"></div>
                                                </div>
                                            </div>
                                            <input v-model="fields.is_optional" id="is_optional" name="is_optional" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="is_optional" class="font-medium text-gray-700">This step is optional</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Allow multiple select</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <fieldset>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.allow_multiple = !fields.allow_multiple]">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.allow_multiple}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.allow_multiple}"></div>
                                            </div>
                                        </div>
                                        <input id="allow_multiple" v-model="fields.allow_multiple" name="allow_multiple" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_multiple" class="font-medium text-gray-700">Allow mutiple selection</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Parent product</p>
                            <p class="text-gray-500">To which product would u like to add this step? To which products does this step apply?</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <fieldset>
                                <div class="space-y-4">
                                    <div class="flex" v-for="product in configurableProducts">
                                        <div class="flex items-center justify-center ">
                                            <div class="flex items-center h-5">
                                                <div class="flex justify-between items-center" @click="()=>{AddOrDeleteFromSelectedConfigurableProducts(product)}">
                                                    <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': parentProducts.some(value => value.id === product.id )}">
                                                        <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': parentProducts.some(value => value.id === product.id )}"></div>
                                                    </div>
                                                </div>
                                                <input v-model="fields.is_optional" id="is_optional" name="is_optional" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <input :id="product.id" :value="product.id" :name="product.id" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 flex w-100">
                                            <div class="w-4/6">
                                                <label :for="product.id" class="font-medium text-gray-700 m-0">{{ product.name }}</label>
                                                <label :for="product.id" class="text-gray-500 block">{{ product.description | truncate(32) }}</label>
                                            </div>
                                            <div class="w-2/6 flex items-center justify-end">
                                                <label :for="product.id">{{ product.price | currency('€ ')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Interaction type</p>
                            <p class="text-gray-500">How do you want the useers to interact with this step. This will only allow products to be added with the selected interaction type</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="relative">
                                <select v-model.trim="$v.fields.interaction_type.$model" type="text" :class="{ 'border-red-500' : submitted && !$v.fields.interaction_type.required}" name="interaction_type" id="interaction_type" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option value="">Kies een type</option>
                                    <option v-for="type in interactionTypes" :value="type.id" :selected="fields.interaction_type === type">{{ type.name }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.interaction_type.required">
                                    <svg v-if="submitted && !$v.fields.interaction_type.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-500 font-medium my-3" v-if="submitted && !$v.fields.interaction_type.required">Interactie type is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Add products</p>
                            <p class="text-gray-500">Which products would you like to add to this step? These are the products that the user can add to the configuration</p>
                        </div>
                        <div class="w-100 xl:w-8/12 space-y-2">
                            <transition-group class="space-y-2" appear enter-active-class="animate__animated animate__fadeIn" leave-
                                              active-class="animate__animated animate__fadeOut" mode="out-in">
                                <div class="grid grid-cols-12 gap-5 shadow-sm p-3 border border-gray-200 rounded-lg" v-for="product in fields.options" :key="product.id">
                                    <div class="col-span-2 flex align-items-center">
                                        <img :src="product.thumbnail" alt="" class="h-12 w-12 rounded bg-cover">
                                    </div>
                                    <div class="col-span-4 flex flex-column">
                                        <p class="font-medium">{{ product.name }}</p>
                                        <p class="font-medium text-gray-500">{{ parseFloat(product.price) | currency('€ ') }}</p>
                                    </div>
                                    <div class="col-span-4 flex items-center justify-center">
                                        <input @click="fields.defaultProduct = product.id" :checked="product.id === fields.defaultProduct" id="default_product" name="default_product" :value="product.id" type="radio" class="form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="default_product" class="ml-3 mb-0 block text-sm font-medium">
                                            Default
                                        </label>
                                    </div>
                                    <div class="col-span-2 flex items-center">
                                        <div class="flex space-x-4">
                                            <form action="">
                                                <input type="hidden" name="_token" :value="csrf">
                                                <input type="hidden" :value="JSON.stringify(product)" name="product">
                                                <div class="flex space-x-4">
                                                    <a :href="'/dashboard/product/' + product.id + '/edit'" class="hover:text-indigo-500 text-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="hover:text-indigo-500" v-on:click="removeProductFromList(product)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </transition-group>

                            <div class="">
                                <a href="#" v-on:click="openModal(); getProductsWithInteractionType(fields.interaction_type);">
                                    <div class="border-2 border-dashed border-gray-400 hover:border-blue-500 hover:text-blue-500 h-32 w-100 flex-column rounded-md flex justify-center items-center transition">
                                        <div class="bg-gray-100 h-16 w-16 flex items-center justify-center rounded-full text-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-column-reverse xl:flex-row space-y-5 xl:space-y-0 xl:float-right my-10 xl:space-x-5">
                        <a href="/dashboard/steps" class="w-full xl:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 mt-2 xl:mt-0 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            Cancel
                        </a>
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="loading">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <button type="submit" v-on:click="updateStep()" class="w-full xl:w-auto bg-indigo-500 rounded-md p-2 px-4 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Update step</button>
                    </div>
                </div>
            </div>
        </div>
        <modal ref="modal" :interaction-type="fields.interaction_type" :selected-products="fields.options" :products="products"></modal>
    </div>
</template>

<script>
import Modal from "./modalComponent";
import { required } from "vuelidate/lib/validators";

export default {
    data () {
        return {
            fields: {
                allow_multiple: this.step.allow_multiple,
                interaction_type: this.step.interaction_type,
                is_optional: this.step.is_optional,
                name: this.step.name,
                options: this.step.options,
                defaultProduct: this.step.default_product,
            },
            ValName: this.step.name,
            interactionTypes: {},
            selectedProducts: [],
            products: {},
            configurableProducts: {},
            parentProducts: [],
            loading: false,
            submitted: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    props: ['step'],

    mounted: function() {
        this.getInteractionTypes();
        this.getConfigurableProducts();
        this.getParentProducts(this.step);
    },
    components: {
        Modal
    },
    methods: {
        openModal() {
            this.$refs.modal.showModal = true;
        },
        getInteractionTypes() {
            axios.get('/api/get/interaction_types')
                .then(response => {
                    this.interactionTypes = response.data
                }).catch(err => {
                console.log(err)
            });
        },
        removeProductFromList: function(product) {
            this.fields.options.forEach(function(value, index) {
                if(value.name === product.name) {
                    this.fields.options.splice(index, 1);
                }
            }, this);

            axios.delete('/api/delete/step/' + this.step.id + '/option', {
                data: {product: product},
                headers: { "X-Requested-With": "XMLHttpRequest","Content-Type": "application/json" }
            }).then(response => {
                console.log("Product succesvol verwijderd")
            }).catch(err => {
                console.log(err);
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
        getProductsWithInteractionType: function(interactionType) {
            axios.get('/api/get/products/interaction_type/' + interactionType)
                .then(response => {
                    this.products = response.data
                }).catch(err => {
                console.log(err)
            });
        },
        getParentProducts: function(step) {
            axios.get('/api/get/parentProducts/' + step.id)
                .then(response => {
                    this.parentProducts = response.data
                }).catch(err => {
                console.log(err)
            });
        },
        AddOrDeleteFromSelectedConfigurableProducts: function(product) {
            if(this.parentProducts.some(value => value.id === product.id )){
                console.log("staat al in array");
                this.parentProducts.forEach(function(value, index) {
                    if(value.name === product.name) {
                        this.parentProducts.splice(index, 1);
                    }
                }, this);
            } else {
                this.parentProducts.push(product)
                console.log("staat  in array");
            }
        },
        updateStep: function() {
            this.submitted = true
            this.$v.$touch()

            if(this.$v.$error) {
                return
            } else {
                axios.patch('/api/update/step/' + this.step.id, {
                    data: {
                        fields: this.fields,
                        parentProducts: this.parentProducts,
                    },
                    headers: { "X-Requested-With": "XMLHttpRequest","Content-Type": "application/json" }
                }).then(response => {
                    this.loading = false
                    window.location = "/dashboard/steps"
                }).catch(err => {
                    console.log(err)
                });
            }
        }
    },
    validations: {
        fields: {
            name: {
                required
            },
            interaction_type: {
                required
            }
        }
    }
}
</script>
