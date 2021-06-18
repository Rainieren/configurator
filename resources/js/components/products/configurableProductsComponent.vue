<template>
    <div class="relative">
        <button type="button" class="bg-white shadow-sm relative min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200 flex flex-column h-100 w-100" v-on:click="[activeProduct = product, summary = parseFloat(activeProduct.price), options = [], getAllRelatedSteps(product.id)]" :class="{'border-indigo-500': activeProduct === product, 'pointer-events-none opacity-50': product.stock === 0 || !product.status}">
            <div class="absolute bg-indigo-500 rounded-full -right-3 -top-3" v-if="activeProduct === product">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="p-3 border-b border-gray-300 h-auto w-100">
                <div class="flex">
                    <div class="w-2/3 text-left">
                        <p class="font-bold">{{ product.name }}</p>
                        <p v-if="product.description" class="text-gray-800">{{ product.description.substring(0,32) }}</p>
                    </div>
                    <div class="w-1/3 text-right">
                        <p class="text-md">{{ parseFloat(product.price) | currency('€ ')}}</p>
                        <p class="" v-if="product.stock === 1">
                            <span class="text-green-500 font-medium font-sm flex justify-end align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                In stock
                            </span>
                        </p>
                        <p v-if="product.stock === 0">
                            <span class="text-red-500 font-medium font-sm flex justify-end align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                Out of stock
                            </span>
                        </p>
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
        </button>
    </div>
</template>

<script>
export default {
    data () {
        return {
            activeProduct: this.active,
            chosenOptions: this.options
        };
    },
    props: ['active', 'options', 'product', 'getAllRelatedSteps'],
    methods: {
        getSteps: function(id) {
            this.getAllRelatedSteps(id)
        }
    }
}
</script>
