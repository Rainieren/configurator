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
                            <input name="name" id="name" type="text" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Optional</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input v-model="fields.isOptional" id="is_optional" name="is_optional" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
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
                            Als je deze optie aanzet kan je meerdere opties selecteren binnen de stap i.p.v 1
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
                                    <div class="flex" v-for="product in configurableProducts">
                                        <div class="flex items-center justify-center ">
                                            <input :id="product.id" :value="product.id" @click="()=>{AddSelectedConfigurableProducts(product.id)}" :name="product.id" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
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
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Interaction type</p>
                            <p class="text-gray-500">How do you want the useers to interact with this step. This will only allow products to be added with the selected interaction type</p>
                        </div>
                        <div class="w-8/12">
                            <select v-model="fields.interactionType" type="text" name="interaction_type" id="interaction_type" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                <option v-for="type in interactionTypes" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Add products</p>
                            <p class="text-gray-500">Which products would you like to add to this step? These are the products that the user can add to the configuration</p>
                        </div>
                        <div class="w-8/12 space-y-5">
                            <div class="grid grid-cols-10 gap-5 space-x-5 shadow-sm p-3" v-for="product in selectedProducts">
                                <div class="di">
                                    <img :src="product.thumbnail" alt="" class="h-12 w-12 rounded bg-cover">
                                </div>
                                <div class="col-span-8 flex items-center">
                                    <p class="font-medium">{{ product.name }}</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex space-x-4">
                                        <a href="#" @click="removeProductFromList(product)" class="">
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
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-blue-700 transition">Create step</button>
                    </div>
                </form>
            </div>
        </div>
        <modal ref="modal" :interaction-type="fields.interactionType" :selected-products="selectedProducts" :products="products"></modal>
    </div>
</template>

<script>
    import Modal from "./modalComponent";

    export default {
        data () {
            return {
                fields: {
                    interactionType: 1,
                    isOptional: false
                },
                selectedProducts: [],
                interactionTypes: {},
                products: {},
                configurableProducts: {},
                selectedConfigurableProducts: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            AddSelectedConfigurableProducts: function(id) {
                if(this.selectedConfigurableProducts.includes(id)){
                    this.selectedConfigurableProducts=_.without(this.selectedConfigurableProducts,id)
                }else{
                    this.selectedConfigurableProducts.push(id)
                }
            }
        },
    }
</script>
