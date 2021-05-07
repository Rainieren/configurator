<template>
    <div class="p-5">
        <div class="flex space-x-10">
            <div class="w-6/12">
                <form action="/dashboard/step/store" method="POST" class="w-full my-2" id="productCreateForm">
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
                            <p class="text-gray-800 font-medium text-lg">Step type</p>
                            <p class="text-gray-500">How do you want the useers to interact with this step. This will only allow products to be added with the selected interaction type</p>
                        </div>
                        <div class="w-8/12">
                            <select v-model="fields.interactionType" type="text" name="input_field_type" id="input_field_type" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                <option v-for="type in interactionTypes" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Add a product</p>
                            <p class="text-gray-500">Which products would you like to add to this step? </p>
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
                                <a href="#" @click="openModal">
                                    <div class="border-2 border-dashed border-gray-400 hover:border-blue-500 hover:text-blue-500 h-32 w-100 flex-column rounded-md flex justify-center items-center transition">
                                        <p>Add a product</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex float-right my-5 space-x-5">
                        <a href="" class="bg-gray-300 rounded p-2 text-center text-black hover:text-blue-500 hover:no-underline transition">Cancel</a>
                        <button type="submit" class="bg-blue-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-blue-700 transition">Create step</button>
                    </div>
                </form>
            </div>
        </div>
        <modal ref="modal" :interaction-type="fields.interactionType" :selected-products="selectedProducts"></modal>
    </div>
</template>

<script>
    import Modal from "./modalComponent";

    export default {
        data () {
            return {
                fields: {
                    interactionType: 1,
                },
                selectedProducts: [],
                interactionTypes: {},
            };
        },
        mounted: function() {
            this.getInteractionTypes();
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
                if(this.selectedProducts.includes(product)) {
                    this.selectedProducts.splice(product, 1)
                }
            }
        },
    }
</script>
