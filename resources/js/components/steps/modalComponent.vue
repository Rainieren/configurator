<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <transition name="fade">
    <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-filter backdrop-blur-sm transition" aria-hidden="true" @click="showModal = false"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="w-50 inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                <div class="bg-white px-4 pt-4 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="">

                            <div v-if="!products.length" class="f">
                                <div class="w-100 text-center flex items-center justify-center flex-column p-5">
                                    <p class="font-medium text-lg">Sorry, At this moment there are no product available with the chosen interaction type. Create a new product with the right interaction type or change a existing one</p>
                                    <img :src="'/images/empty_1.svg'" class="w-1/3 my-24" alt="">
                                </div>
                            </div>
                            <div class="mt-2" v-if="!loading && products.length">
                                <p class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Producten toevoegen
                                </p>
                                <div class="flex justify-center flex-column items-center my-5" v-if="loading">
                                    <svg class="animate-spin mr-3 h-8 w-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <p class="font-medium my-3">Producten ophalen</p>
                                </div>
                                <div class="flex flex-col my-4 h-75 ">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                                            <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-white">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Select
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Thumbnail
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Name
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Price
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Interaction type
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200" v-for="(product, index) in products" v-bind:index="index">
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <input type="checkbox" :id="product.id" :key="product.id" @change="addToArray(product, index)" :value="product.id">
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <img :src="product.thumbnail" class="h-12 w-12 rounded bg-cover" alt="">
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ product.name }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ product.price | currency('€ ') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ checkInteractionType() }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex">
                    <div class="w-1/2 flex items-center">
                        <p class="font-medium" v-if="selectedProducts.length">Producten geselecteerd: {{ selectedProducts.length }}</p>
                    </div>
                    <div class="w-1/2 text-right flex flex-row-reverse">
                        <button v-if="products.length" @click="showModal = false" type="button" class="w-full inline-flex justify-center rounded-md border border-indigo-300 shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Toevoegen
                        </button>
                        <button @click="emptyArrayAndCloseModal()" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </transition>
</template>

<script>
export default {
    props: ['interactionType', 'selectedProducts', 'products'],
    data () {
        return {
            showModal: false,
            // loading: true,
        };
    },
    methods: {
        addToArray: function(product, index) {
            console.log(product.name)
            if(this.selectedProducts.includes(product)) {
                this.selectedProducts.splice(product, 1)
            } else {
                this.selectedProducts.push(product);
            }
        },
        emptyArrayAndCloseModal: function() {
            this.showModal = false;
        },
        checkInteractionType: function() {
            if(this.interactionType === 1) {
                return "Card"
            } else if (this.interactionType === 2) {
                return "Radio"
            } else {
                return "Input"
            }
        }
    }
}
</script>
