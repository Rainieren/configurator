<template>
    <div class="px-20">
        <div class="flex space-x-10">
            <div class="w-6/12">
                <form action="/dashboard/step/store" method="POST" class="w-full my-2" id="productCreateForm">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Name</p>
                        </div>
                        <div class="w-8/12">
                            <div class="relative">
                                <input v-model.trim="$v.fields.name.$model" name="name" id="name" type="text" :class="{'border-red-600': submitted && !$v.fields.name.required || !$v.fields.name.maxLength}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" autofocus>
<!--                                <svg xmlns="http://www.w3.org/2000/svg" v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-600 absolute top-2 right-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />-->
<!--                                </svg>-->
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.name.required">
                                    <svg v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.required">Naam is verplicht!</p>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.maxLength">Naam mag niet meer dan 128 Karakters bevatten!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Optional</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="flex items-center">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.is_optional = !fields.is_optional], [fields.defaultProduct = '']">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': !fields.defaultProduct && fields.is_optional}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': !fields.defaultProduct && fields.is_optional}"></div>
                                            </div>
                                        </div>
                                        <input v-model="fields.is_optional" id="is_optional" name="is_optional" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="is_optional" class="font-medium text-gray-700">This step is optional</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Allow multiple select</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="flex items-center">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.allow_multiple = !fields.allow_multiple]">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.allow_multiple}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.allow_multiple}"></div>
                                            </div>
                                        </div>
                                        <input id="allow_multiple" v-model="fields.allow_multiple" name="allow_multiple" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_multiple" class="font-medium text-gray-700">Allow multiple selection</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Parent product</p>
                            <p class="text-gray-500">To which product would u like to add this step? To which products does this step apply?</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="space-y-4">
                                    <div class="" v-if="configurableProducts.length != 0">
                                        <div class="flex" v-for="product in configurableProducts">
                                            <div class="flex items-center justify-center">
                                                <div class="flex items-center h-5">
                                                    <div class="flex justify-between items-center" @click="()=>{AddSelectedConfigurableProducts(product.id)}">
                                                        <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': selectedConfigurableProducts.includes(product.id)}">
                                                            <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': selectedConfigurableProducts.includes(product.id)}"></div>
                                                        </div>
                                                    </div>
                                                    <input v-model="fields.is_optional" id="ddd" name="is_optional" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
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
                                    <div class="flex justify-center items-center flex-column text-center" v-else>
                                        <p class="font-medium">There are no product yet. To assign this step to a product please create a product first. Or create a step without a parent product</p>
                                        <a href="/dashboard/product/create" class="text-indigo-500">Create a product</a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Interaction type</p>
                            <p class="text-gray-500">How do you want the useers to interact with this step. This will only allow products to be added with the selected interaction type</p>
                        </div>
                        <div class="w-8/12">
                            <div class="relative">
                                <select v-model.trim="$v.fields.interactionType.$model" @change="selectedProducts = []" type="text" :class="{'border-red-600': submitted && !$v.fields.interactionType.required}" name="interaction_type" id="interaction_type" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option value="" selected>Kies een interactie type</option>
                                    <option v-for="type in interactionTypes" :value="type.id">{{ type.name }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.interactionType.required">
                                    <svg v-if="submitted && !$v.fields.interactionType.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.interactionType.required">Interactie type is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Add products</p>
                            <p class="text-gray-500">Which products would you like to add to this step? These are the products that the user can add to the configuration</p>
                        </div>
                        <div class="w-8/12 space-y-5">
                            <div class="grid grid-cols-10 gap-5 space-x-5 shadow-sm p-3 border border-gray-200 rounded-md" v-for="product in selectedProducts">
                                <div class="flex align-items-center">
                                    <img :src="product.thumbnail" alt="" class="h-12 w-12 rounded bg-cover">
                                </div>
                                <div class="col-span-4 flex flex-column">
                                    <p class="font-medium">{{ product.name }}</p>
                                    <p class="font-medium text-gray-500">{{ parseFloat(product.price) | currency('€ ') }}</p>
                                </div>
                                <div class="col-span-4 flex items-center">
                                    <input @click="fields.defaultProduct = product" id="default_product" name="default_product" :value="product.id" type="radio" class="form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="default_product" class="ml-3 mb-0 block text-sm font-medium">
                                        Default
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex space-x-4">
                                        <a href="#" class="hover:text-indigo-500" @click="removeProductFromList(product)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <a href="#" @click="openModal(); getProductsWithInteractionType(fields.interactionType);">
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

<!--                    Alleen de data parsen want er zit gevoelige data in.-->
                    <input type="hidden" :value="JSON.stringify(selectedProducts)" name="selectedProducts[]">
                    <input type="hidden" :value="JSON.stringify(selectedConfigurableProducts)" name="addToConfigurableProducts[]">


                    <div class="flex float-right my-5 space-x-5">
                        <button @click="" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                        <button @click.prevent="submitStepCreateForm" type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-500 transition">Create step</button>
                    </div>
                </form>
            </div>
        </div>
        <modal ref="modal" :interaction-type="fields.interactionType" :selected-products="selectedProducts" :products="products"></modal>
    </div>
</template>

<script>
    import Modal from "./modalComponent";
    import {maxLength, minValue, required, requiredIf} from "vuelidate/lib/validators";

    export default {
        data () {
            return {
                fields: {
                    name: '',
                    interactionType: null,
                    is_optional: false,
                    allow_multiple: false,
                    defaultProduct: '',
                },
                selectedProducts: [],
                interactionTypes: {},
                products: {},
                configurableProducts: {},
                selectedConfigurableProducts: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                submitted: false
            };
        },
        mounted: function() {
            this.getInteractionTypes();
            this.getConfigurableProducts();
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
            getProductsWithInteractionType: function(interactionType) {
                axios.get('/api/get/products/interaction_type/' + interactionType)
                    .then(response => {
                        this.products = response.data
                    }).catch(err => {
                    console.log(err)
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
            submitStepCreateForm: function() {
                this.submitted = true
                this.$v.$touch()

                if(this.$v.$error) {
                    return
                } else {
                    document.getElementById("productCreateForm").submit();
                }
            },
            AddSelectedConfigurableProducts: function(id) {
                if(this.selectedConfigurableProducts.includes(id)){
                    this.selectedConfigurableProducts=_.without(this.selectedConfigurableProducts.id)
                }else{
                    this.selectedConfigurableProducts.push(id)
                }
            }
        },
        validations: {
            fields: {
                name: {
                    required,
                    maxLength: maxLength(128)
                },
                interactionType: {
                    required
                }
            }
        }
    }
</script>
